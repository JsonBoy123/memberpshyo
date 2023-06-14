<?php

//namespace Modules\Admin\Http\Controllers\AdminController;
namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Models\Country;
use App\Models\CollegeMast;
use App\Models\UserService;
use Auth;
use App\Mail\AllMail;
use App\Mail\ApproveMail;
use App\Mail\IAPMail;
use Mail;
use Modules\Member\Entities\Member;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyMessage;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /** 
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
       
        // return "hello";
        // return   $member_type =  Auth::user()->roles()->pluck('id'); 
        $userServices = UserService::where('user_id',Auth::user()->id)->get();
        $member = Member::where('user_id',Auth::user()->id)->first();

        return view('admin::services.index',compact('userServices'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      
        return view('admin::services.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //return 'hello';
        $data = $this->validation($request);
        $data['form_name'] = $data['url'];
        // return $data;
        $data['doc_url'] = $this->document_store($request);
        Service::create($data);
        return redirect('/service')->with('success','Service added successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {    
        $service = Service::find($id);
        //$userservice = UserService::where('user_id',Auth::user()->id)->where('service_id',$id)->first();
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('admin::services.show',compact('service','member'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $service = Service::find($id);        
        return view('admin::services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['form_name'] = $data['url'];
        $service = Service::find($id);

        if($request->has('file')){
            $olddoc_url = $service->doc_url;
            if($olddoc_url != ''){
                $doc_url = explode('/', $olddoc_url);
                Storage::delete('public/2020/services_docs/'.$doc_url[2]);
            }
            $data['doc_url'] =$this->document_store($request);
        }

        $service->update($data);
        return redirect('/service')->with('success','Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $service = Service::find($id);
        $olddoc_url = $service->doc_url;
        if($olddoc_url != ''){
            $doc_url = explode('/', $olddoc_url);
            Storage::delete('public/2020/services_docs/'.$doc_url[2]);
        }
        $service->delete();
        return redirect('/service')->with('success','Service deleted successfully');

    }

    public function validation($request){
        $data =$request->validate([
            'name' => 'required|string|max:191|min:4',
            'charges'=>  'nullable|string|min:1|max:6',
            'url'    =>  'nullable|string|min:5|max:50',
            'description' => 'nullable',
            'service_type'=> 'required|not_in:""',
            'member_type'=> 'required|not_in:""',
           
        ]);
 // 'from'   =>  'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
 //            'to'     =>  'sometimes|nullable|date_format:Y-m-d|after_or_equal:from',

        // if($request->service_type == 'S'){
        //     $request->validate([
        //         'to' => 'required',
        //     ],
        //     [
        //         'to.required' => 'The end date field is required.'
        //     ]
        //     );
        // }

        return $data;
    }

    public function document_store($request){
        if($request->has('file')){
            $file = $request->file('file');
            $filename =  time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public/'.date('Y').'/services_docs', $filename);
            $url = (date('Y').'/services_docs/'.$filename);
           return $url;
        }
    }
    public function services_docs($id){
        $service = Service::find($id);      
        return  Storage::download('public/'.$service->doc_url);
    }

    public function member_document(Request $request){

        $request->validate([
            'file' => 'required'
        ]);
        if($request->has('file')){
            return $request->file;
        }
    } 

    public function members_list(){
        $services = Service::whereIn('id',['10','11','12','13','14'])->get();

        $members = Member::with('applied_services')->where('status','A')->orderBy('regn_date', 'DESC')->get();
        
        return view('admin::member.index',compact('members','services'));
    }

    public function members_list_fetch(Request $request){
        $members = Member::with('applied_services')->orderBy('regn_date', 'DESC');
        $member_status = $request->member_status;
        $status = $request->status;

        if($status == '0'){
            $members = $members;
        }elseif($status == '1'){
            $members = $members->where('old_or_new','0');
        }elseif($status == '2'){
            $members = $members->where('old_or_new','1');
        }

        if($member_status == '0'){
            $members = $members;
        }elseif($member_status == '1'){
            $members = $members->where('status','A');

        }else{
            $members = $members->where('status','P');
        }
        $members = $members->get();
        return view('admin::member.table',compact('members'));
    }
    public function member_service_assign(Request $request){
         
        $data = [
            'user_id' => $request->user_id,
            'service_id' => $request->service,
            'status' => 'A',
            'payment_id' => $request->payment_id !='' ? $request->payment_id : '0',
            'payment_status' => '1',

        ];
        
        UserService::create($data);

        // Member::where('user_id',$request->user_id)->update(['status' => 'A','iap_no' => $request->iap_no]);
        Member::where('user_id',$request->user_id)->update(['status' => 'A']);

        $user = User::find($request->user_id);
        $message = [
            'id'     => $request->user_id,
            'message'=> 'IAP member active your account fill all the details.',
            'title'  => 'Member service assign check your member service.',
            'link'   => '/home'
        ];

        $user->notify(new NotifyMessage($message));
        return back()->with('success','Member service assign successfully.');
    } 
    public function member_services($id){
        $member_services = Member::with('service')->where('user_id',$id)->get();
        return view('admin::member.service_table',compact('member_services'));
    }

    // public function coming_soon($id){
    //     $service = Service::find($id);
    //     return view('admin::services.forms.coming_soon',compact('service'));
    // }

    // public function iap_membership($id){
    //     $colleges = CollegeMast::pluck('college_name','college_code');
    //     $colleges->prepend('Select IAP Member College','');
    //     $countries = Country::pluck('country_name','country_code');
    //     $countries->prepend('Select Country','');
    //     $service = Service::find($id);
    //     return view('admin::services.forms.iap_membership',compact('countries','service','colleges'));
    // }

    // public function iap_membership_store(Request $request){

    //     $data = $request->validate([
    //                 'first_name'            => 'required',
    //                 'middle_name'           => 'nullable',
    //                 'last_name'             => 'required',
    //                 'mobile'                => 'required',
    //                 'mobile1'               => 'nullable',
    //                 'email'                 => 'required',
    //                 'email1'                => 'nullable|email',
    //                 'relation_type'         => 'nullable',
    //                 'gender'                => 'required|not_in:""',
    //                 'dob'                   => 'required',
    //                 'place_of_birth'        => 'nullable',
    //                 'country_of_birth'      => 'nullable',
    //                 'dob'                   => 'required',
    //                 'blood_group'           => 'nullable',
    //                 'rel_f_name'            => 'nullable',
    //                 'rel_m_name'            => 'nullable',
    //                 'rel_l_name'            => 'nullable',
    //                 'p_address'             => 'required',
    //                 'p_country'             => 'required',
    //                 'p_state'               => 'required',
    //                 'p_city'                => 'required',
    //                 'p_zip_code'            => 'required',
    //                 'same_as'               => 'nullable',
    //                 'c_address'             => 'required',
    //                 'c_country'             => 'required',
    //                 'c_state'               => 'required',
    //                 'c_city'                => 'required',
    //                 'c_zip_code'            => 'required',
    //                 'qualification_type'    => 'nullable',
    //                 'qualification_name'    => 'nullable',
    //                 'qualification_university'=> 'nullable',
    //                 'qualification_year_pass' => 'nullable',
    //     ]);

    //     if($request->service_id == '10' || $request->service_id == '12'){
    //         $request->validate([
    //             'college_code' => 'required|not_in:""'
    //         ]);
    //         $data['college_code'] = $request->college_code;

    //     }else{
    //         $request->validate([
    //             'college_name' => 'required'
    //         ]);
    //         $data['college_name'] = $request->college_name;
    //     }

    //     if($request->address_proof_type !=''){
    //         $request->validate([
    //             'address_proof_doc' => 'required|mimes:jpeg,jpg,png,pdf'
    //         ]);
    //     }

    //     if($request->hasfile('address_proof_doc')){
    //         $request->validate([
    //             'address_proof_type' => 'required|not_in:""'
    //         ]);
    //         // $file = $request->file('address_proof_doc');
    //         // $filename =  time().'_'.$file->getClientOriginalName();
    //         // $path = $file->storeAs('public/'.date('Y').'/members', $filename);
    //         // $url = Storage::url(date('Y').'/abstractimages/'.$filename);
    //         // $data['image'] = $url;
    //     }

    //     $data['user_id'] = Auth::user()->id;
    //     $member = Member::create($data);
    //     $userService =UserService::create([
    //         'user_id'   => Auth::user()->id,
    //         'service_id' => $request->service_id,
    //     ]);

    //     $message = [
    //         'id'     => $userService->id,
    //         'title'  => 'Member Applied Serivce',
    //         'message'=> $member->first_name.($member->middle_name !=null ? ' '.$member->middle_name : '' )." ". $member->last_name .' member service applied.',
    //         'link'   => '/approval/service_request',
    //     ];

    //     $users = User::whereRoleIs('member_admin')->get();
    //     Notification::send($users, new NotifyMessage($message));

    //    return redirect('service/payment/'.$member->id);
        
    // }


    // public function service_payment($id){
    //   $member =  Member::find($id);
    //   $userservice = UserService::where('member_id',$id)->first();
    //   $service = Service::find($userservice->service_id);


    //   return view('admin::payments.form_payment',compact('service','member'));
    
    //     // $data = [
        
    //     //         'name'  => "IAP Physiotherapy",
    //     //         'price' => $service->charges,
    //     //         'desc'  => $service->name,
    //     //         'qty'   => 1
            
    //     // ];
    //     // return $data;

    //     // $data['invoice_id'] = 1;
    //     // $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
    //     // $data['return_url'] = route('payment.success');
    //     // $data['cancel_url'] = route('payment.cancel');
    //     // $data['total'] = 100;
    // }
    // public function payment_now($id){
    //   $userservice = UserService::where('member_id',$id)->first();
    //   $service = Service::find($userservice->service_id);

    //   // return $service;
    //    $data = [];
    //     $data['items'] = [
    //         [
    //             'name' => $service->name,
    //             'price' => $service->charges,
    //             'desc'  => 'Member Service Payment',
    //             'qty' => 1
    //         ]
    //     ];

    //     $data['invoice_id'] = 1;
    //     $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
    //     $data['return_url'] = route('payment.success');
    //     $data['cancel_url'] = route('payment.cancel');
    //     $data['total'] = 100;

    //     $provider = new ExpressCheckout;

    //     $response = $provider->setExpressCheckout($data);

    //     $response = $provider->setExpressCheckout($data, true);


    //     return redirect($response['paypal_link']);


    //   return $userservice;
    // }
 

    public function new_members_list()
    {
        $members = Member::with('applied_services')->where('any_other_doc','!=','NULL')->orderBy('regn_date', 'DESC')->get();
        return view('admin::new memeber.new_member',compact('members'));
    }


    public function new_members_list_fetch($id)
    {
        $service = Member::where('id',$id)->first();
        //return $service;
        return view('admin::new memeber.member_show_detail',compact('service'));
    }

    // public function service_profile_approve(Request $request){
    //    //return $request->all();die;
    //    $userservice =  UserService::find($request->id);
    //    $service = Service::find($userservice->service_id);
    //    $user = User::find($userservice->user_id);
    //    if($userservice->service_id !='14'){
    //         $data = [
    //             'status' => 'A',
    //             'start_date' => $request->start_date,
    //             'end_date' => $request->end_date
    //         ];

    //         // if($userservice->old_or_new =='1'){
    //         //     $data['old_or_new'] = '1';
    //         // }
              
    //        UserService::where('id',$request->id)->update($data);
          
    //             $invc_data = new Invoice;
    //             $invc_data->invc_date = date('Y-m-d');
    //             $invc_data->user_id = $userservice->user_id;
    //             $invc_data->name = $user->name;
    //             $invc_data->service_id = $userservice->service_id;
    //             $invc_data->service_name = $service->name;
    //             $invc_data->charges = $userservice->charges;
    //             $invc_data->cgst = (($userservice->tx_flag == '2') ? $userservice->tax_charges/2 : $userservice->tax_charges);
    //             $invc_data->sgst = (($userservice->tx_flag == '2') ? $userservice->tax_charges/2 : $userservice->tax_charges);
    //             $invc_data->invc_status = 'P';
    //             $invc_data->tx_flag = $userservice->tx_flag;
    //             $invc_data->save();

    //         $message = [
    //             'id'        => $request->id,
    //             'title'     => 'IAP admin approve your service',
    //             'message'   => 'Check your mail & follow the next process of service payment.',
    //             'link'       => '/service'
    //         ];
    //         Mail::to($user->email)->send(new ApproveMail());
    //    }else{
    //         $member = Member::where('user_id',$userservice->user_id)->first();
    //         $member->update(['status' => 'A']);

    //         $userservice->update(['status' => 'A','start_date' => $request->start_date,'end_date' => $request->end_date,'payment_id' => 'default','payment_status' => '1','old_or_new' => '1']);  
           
    //                   $invc_data = new Invoice;
    //                   $invc_data->invc_date = date('Y-m-d');
    //                   $invc_data->user_id = $userservice->user_id;
    //                   $invc_data->name = $user->name;
    //                   $invc_data->service_id = $userservice->service_id;
    //                   $invc_data->service_name = $service->name;
    //                   $invc_data->charges = $userservice->charges;
    //                   $invc_data->cgst = (($userservice->tx_flag == '2') ? $userservice->tax_charges/2 : $userservice->tax_charges);
    //                   $invc_data->sgst = (($userservice->tx_flag == '2') ? $userservice->tax_charges/2 : $userservice->tax_charges);
    //                   $invc_data->invc_status = 'A';
    //                   $invc_data->pmnt_type = 'D';
    //                   $invc_data->tx_flag = $userservice->tx_flag;
    //                  $invc_data->save();

    //         $message = [
    //             'id'        => $request->service_id,
    //             'title'     => 'IAP approve your service.',
    //             'message'   => 'IAP sent confirmation message on your mail.',
    //                 'link'       => '/service'
    //         ];

    //         $mail = [
    //             'name' => member_name($member),
    //             'iap_no' => $member->iap_no,
    //         ];

    //         Mail::to($user->email)->send(new IAPMail($mail));
    //    }

    //     sent_message($userservice->user_id,$message);
    //     return 'Member profile active';
    // }

    public function service_profile_approve(Request $request){
        $userservice =  Member::find($request->id);
        $userservice->update(['status' => 'A']);
        
        $message = [
                'id'        => $request->service_id,
                'title'     => 'IAP approve your profile.',
                'message'   => 'IAP sent confirmation message on your mail.',
                    'link'       => '/service'
            ];

            $mail = [
                'name' => member_name($member),
                'iap_no' => $member->iap_no,
            ];

        Mail::to($user->email)->send(new IAPMail($mail));

        sent_message($userservice->user_id,$message);
        
        return 'Member profile active';
    }


    public function service_profile_decline(Request $request){
        // return $request;
        $userservice =  Member::find($request->service_id);
        $userservice->update(['status' => 'S','reason' => $request->reason]);
        $message = [
            'id'        => $request->service_id,
            'title'     => 'IAP admin decline your service',
            'message'   => 'Your service request has been declined.We will sent reason on your mail.',
            'link'       => '/service'
        ];

        sent_message($userservice->user_id,$message);

        $user = User::find($userservice->user_id);

        $mail = [
            'message' => 'Your service request has been declined by IAP. check the reason and apply again with correct details.'. 'Check The Reason :-'.$request->reason,
            'title' => 'IAP admin declined your service'
        ];

        Mail::to($user->email)->send(new AllMail($mail));

        return redirect()->back()->with('success','Member profile form declined successfully');
    }

}
