<?php

//namespace Modules\Admin\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Models\Country;
use App\Models\CollegeMast;
use App\Models\UserService;
use App\Models\Invoice;
use Auth;
use Modules\Member\Entities\Member;
use Modules\Admin\Entities\MemberType;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyMessage;
use Modules\Member\Entities\MemberQual;
use Modules\Member\Entities\QualCatgMast;
use Illuminate\Support\Facades\DB;

class ServiceFormController extends Controller
{
    public function coming_soon($id){
        $service = Service::find($id);
        return view('admin::services.forms.coming_soon',compact('service'));
    }

    public function iap_membership($id){     
        $service = Service::find($id);
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership',compact('service','member'));
        // return view('admin::services.forms.iap_membership',compact('service','member'));
    }

    public function iap_membership_store(Request $request){
        
       $data = $this->iap_membership_validation($request);
       $member = Member::where('user_id',Auth::user()->id)->first();

		if($request->service_id =='14'){
			$request->validate([
			    'iap_no'           => 'required',
			    'iap_certificate'  => 'required|image|mimes:jpeg,png,jpg|max:2048'
			]);

			$data['iap_no'] = 'L-'.$request->iap_no;

		}

       // return $this->qualification_add($request);

        // $request->validate([
        //     'address_proof_doc' =>'required|image|mimes:jpeg,png,jpg|max:2048', 
        //     'address_proof_type' => 'required|not_in:""',
        //     'signature' => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'photo'     => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'ten_doc'  => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'twelve_doc'  => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'internship_doc' => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'bpt_doc'   => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'mpt_doc'   => 'nullable|mimes:jpeg,png,jpg|max:2048',
        //     'gov_proof' => 'required|mimes:jpeg,png,jpg|max:2048',
        //     'gov_proof1'=> 'required|mimes:jpeg,png,jpg|max:2048',
        //     'any_other_doc' => 'required|mimes:jpeg,png,jpg|max:2048'
        // ]); 


        $request->validate([
            'address_proof_doc' =>'required|image|mimes:jpeg,png,jpg|max:2048', 
            'address_proof_type' => 'required|not_in:""',
            'signature' => 'required|mimes:jpeg,png,jpg|max:2048',
            'photo'     => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 

// return $data;
        $data = $this->document_upload($request,$data);

        //$this->qualification_add($data);

        $data['approval'] = '1';      
        $data['user_id'] = Auth::user()->id;
        $data['services'] = json_encode(['show' => ['2','5',$request->service_id],'apply' => []]);
        
        $member->update($data);


        //$this->service_create($request,$member);

        // $userService =UserService::create([
        //     'user_id'   => Auth::user()->id,
        //     'service_id' => $request->service_id,
        // ]);

        // $message = [
        //     'id'     => $userService->id,
        //     'title'  => 'Member Applied Serivce',
        //     'message'=> member_name($member).' member service applied.',
        //     'link'   => '/approval/service_request',
        // ];

        // $users = User::whereRoleIs('member_admin')->get();
        // Notification::send($users, new NotifyMessage($message));
        //return view('admin::services.forms.iap_membership_tenth');
       return redirect('/services/iap_membership_tenth')->with('success','Please upload all documents from Documents section for completing the profile.');
        
    }
    public function iap_membership_edit($id){
        $member = Member::where('user_id',$id)->first();
        // return $member;
        $userservice = UserService::where('user_id',$id)->first();
        $service = Service::find($userservice->service_id);
        
        return view('admin::services.forms.edit_iap_membership',compact('service','member'));
    }
    public function iap_membership_update(Request $request,$id){
        
        $member = Member::find($id);
        $data = $this->iap_membership_validation($request);
        
        $data = $this->document_upload($request,$data,$member);
        // return $data;

        $data['approval'] = '0';        
        $member->update($data);
        return redirect('/service')->with('success',"Service Updated successfully after approval service you can't edit");
    }

    public function iap_membership_validation($request){
        $data = $request->validate([
            'first_name'            => 'required',
            'middle_name'           => 'nullable',
            'last_name'             => 'required',
            'mobile'                => 'required',
            'mobile1'               => 'nullable',
            'email'                 => 'required',
            'email1'                => 'nullable|email',
            'relation_type'         => 'nullable',
            'gender'                => 'required|not_in:""',
            'dob'                   => 'required|before:5 years ago|date_format:Y-m-d',
            'place_of_birth'        => 'nullable',
            'country_of_birth'      => 'nullable',
            'blood_group'           => 'nullable',
            'rel_f_name'            => 'nullable',
            'rel_m_name'            => 'nullable',
            'rel_l_name'            => 'nullable',
            'p_address'             => 'required',
            'p_country'             => 'required',
            'p_state'               => 'required',
            'p_city'                => 'required',
            'p_zip_code'            => 'required',
            'same_as'               => 'nullable',
            'c_address'             => 'required',
            'c_country'             => 'required',
            'c_state'               => 'required',
            'c_city'                => 'required',
            'c_zip_code'            => 'required',
            'tx_flag'               => 'nullable',
            'qualification_type'    => 'required',
            'qualification_name'    => 'required',
            'qualification_university'=> 'required|min:3|max:100',
            'qualification_year_pass' => 'required|integer|min:1900|max:'.date('Y'),
           
        ]);

        if($request->relation_type !=null){
            $request->validate([
                'rel_f_name'            => 'required',
                'rel_m_name'            => 'nullable',
                'rel_l_name'            => 'required',
            ]);
        }
        
        if($request->c_state == 21){
            $data['tx_flag'] = 1;
        }else{
            $data['tx_flag'] = 2;
        }

        $data['dob'] = date('Y-m-d',strtotime($request->dob));
        if($request->service_id !='14'){
	        // return $data;
	        if($request->service_id == '10' || $request->service_id == '12'){
	            $request->validate([
	                'college_code' => 'required|not_in:""'
	            ]);
	            $data['college_code'] = $request->college_code;

	            if($request->service_id == '10'){
	                $data['member_type'] = '1'; //member for member college
	            }else{
	                $data['member_type'] = '3'; //student for member college
	            }
	            
	        }else{
	            $request->validate([
	                'college_name' => 'required'
	            ]);
	            $data['college_name'] = $request->college_name;

	            if($request->service_id == '11'){
	                $data['member_type'] = '2'; //mmember for non member college
	            }else{
	                $data['member_type'] = '4'; //student for non member college
	            }
	        }
	    }else{
	    	if($request->status == '1'){
	    		$request->validate([
	                'college_name' => 'required'
	            ]);
	            $data['college_name'] = $request->college_name;

	            $data['member_type'] = '6'; //old member for member college	
	           
	    	}else{
	    		$request->validate([
	                'college_code' => 'required|not_in:""'
	            ]);
	            $data['college_code'] = $request->college_code;

	            $data['member_type'] = '5'; //old member for non member college
	    	}
	    }
        return $data;
    }
    public function service_payment($id){

      $userservice = UserService::find($id);

      return view('admin::payments.form_payment',compact('userservice'));
    
        // $data = [
        
        //         'name'  => "IAP Physiotherapy",
        //         'price' => $service->charges,
        //         'desc'  => $service->name,
        //         'qty'   => 1
            
        // ];
        // return $data;

        // $data['invoice_id'] = 1;
        // $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        // $data['return_url'] = route('payment.success');
        // $data['cancel_url'] = route('payment.cancel');
        // $data['total'] = 100;
    }

    public function payment_now(Request $request){
        //return $request->all();
        $userservice = UserService::find($request->service_id);

        $userservice->update(['payment_id' => $request->payment_id]);

        $message = [
        	'id' => $userservice->id,
        	'title'=> 'Member '.member_name($userservice->member). ' pay service payment.',
        	'message' => 'Service payment pay on '.date('Y-m-d'),
        	'link' => '/approval/service_request'

        ];

        $users = User::whereRoleIs('member_admin')->get();
        Notification::send($users, new NotifyMessage($message));

        return redirect('/service')->with('success','Your Request has been sent to IAP admin. Few days you will get a mail about confirmation of payment and service');

    }


    //Documents Upload
    public function iap_membership_tenth(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_tenth',compact('member'));
        //return view('admin::services.forms.iap_membership_tenth',compact('member'));
    }

    public function iap_membership_tenth_doc(Request $request){
        
        $data = [];
        $user_id = Auth::user()->id;
        // $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        $request->validate([
            'ten_doc'  => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        //$data = $this->document_upload($request,$data);
        
        if($request->has('ten_doc')){
            $data['ten_doc'] = file_upload($request->file('ten_doc'),'service/documents','ten_doc',$member2);
             $qualification[]=[
                'qual_catg_code' => '1',
                'qual_catg_desc' => '10th',
                'doc_url'        => $data['ten_doc']         
            ];
         //return $qualification;
            foreach ($qualification as $key => $value) {
            $qual = [
                'user_id'       => $user_id,
                'status'        => 'A',
                'qual_catg_code'=> $value['qual_catg_code'],
                'qual_catg_desc'=> $value['qual_catg_desc'],
                'doc_url'       => $value['doc_url']

            ];
             //return $qual;     
            MemberQual::create($qual);
            }
        }
        //return $data;
        // $tendoc = $data['ten_doc'];
        //$this->qualification_add($data);
        // $member->update($data);
        $doc_status = update_doc_status();
        return redirect('iap_membership_twelve')->with('success','10th Marksheet Uploaded Successfully.');

    }

    public function iap_membership_twelve(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_twelve',compact('member'));
        
    }

    public function iap_membership_twelve_doc(Request $request){   
        $data = [];
        $user_id = Auth::user()->id;
        // $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        //dd($request);
        $request->validate([
            'twelve_doc'  => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        //$data = $this->document_upload($request,$data);
        if($request->has('twelve_doc')){
            $data['twelve_doc'] = file_upload($request->file('twelve_doc'),'service/documents','twelve_doc',$member2);
             $qualification[]=[
                'qual_catg_code' => '2',
                'qual_catg_desc' => '12th',
                'doc_url'        => $data['twelve_doc']         
            ];

            foreach ($qualification as $key => $value) {
            $qual = [
                'user_id'       => $user_id,
                'status'        => 'A',
                'qual_catg_code'=> $value['qual_catg_code'],
                'qual_catg_desc'=> $value['qual_catg_desc'],
                'doc_url'       => $value['doc_url']

            ];
             MemberQual::create($qual);
        }
        }
        
        // $member->update($data);
        $doc_status = update_doc_status();
        return redirect('/iap_membership_intern')->with('success','12th Marksheet uploaded Successfully.');
    }


    public function iap_membership_intern(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_intern',compact('member'));
    }

    public function iap_membership_intern_doc(Request $request){  
        $data = [];
        $user_id = Auth::user()->id;
        // $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
       
        $request->validate([
            'internship_doc' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        
        if($request->has('internship_doc')){
            $data['internship_doc'] = file_upload($request->file('internship_doc'),'service/documents','internship_doc',$member2);
             $qualification[]=[
                'qual_catg_code' => '3',
                'qual_catg_desc' => 'Internship Certificate',
                'doc_url'        => $data['internship_doc']         
            ];

            foreach ($qualification as $key => $value) {
            $qual = [
                'user_id'       => $user_id,
                'status'        => 'A',
                'qual_catg_code'=> $value['qual_catg_code'],
                'qual_catg_desc'=> $value['qual_catg_desc'],
                'doc_url'       => $value['doc_url']

            ];
            
             MemberQual::create($qual);
        }
        }
        
        // $member->update($data);
        $doc_status = update_doc_status();
        return redirect('/iap_membership_bpt')->with('success','Internship Certificate uploaded Successfully.');
    }

    public function iap_membership_bpt(){
         $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_bpt',compact('member'));
        
    }

    public function iap_membership_bpt_doc(Request $request){   
        $data = [];
        $user_id = Auth::user()->id;
        // $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        $request->validate([
            'bpt_doc'   => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        if($request->has('bpt_doc')){
            $data['bpt_doc'] = file_upload($request->file('bpt_doc'),'service/documents','bpt_doc',$member2);
             $qualification[]=[
                'qual_catg_code' => '4',
                'qual_catg_desc' => 'Under Graduate',
                'doc_url'        => $data['bpt_doc']         
            ];

            foreach ($qualification as $key => $value) {
            $qual = [
                'user_id'       => $user_id,
                'status'        => 'A',
                'qual_catg_code'=> $value['qual_catg_code'],
                'qual_catg_desc'=> $value['qual_catg_desc'],
                'doc_url'       => $value['doc_url']

            ];
             MemberQual::create($qual);
        }
        }
        
        // $member->update($data);
        $doc_status = update_doc_status();
        return redirect('/iap_membership_mpt')->with('success','BPT Document uploaded Successfully.');
    }

    public function iap_membership_mpt(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_mpt',compact('member'));
        
    }

    public function iap_membership_mpt_doc(Request $request){   
        $data = [];
        $user_id = Auth::user()->id;
        // $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        $request->validate([
            'mpt_doc'   => 'nullable|mimes:jpeg,png,jpg|max:2048'
            ]); 
        if($request->has('mpt_doc')){
            $data['mpt_doc'] = file_upload($request->file('mpt_doc'),'service/documents','mpt_doc',$member2);
             $qualification[]=[
                'qual_catg_code' => '5',
                'qual_catg_desc' => 'Master',
                'doc_url'        => $data['mpt_doc']         
            ];

            foreach ($qualification as $key => $value) {
            $qual = [
                'user_id'       => $user_id,
                'status'        => 'A',
                'qual_catg_code'=> $value['qual_catg_code'],
                'qual_catg_desc'=> $value['qual_catg_desc'],
                'doc_url'       => $value['doc_url']

            ];
             MemberQual::create($qual);
        }
        }
        
        // $member->update($data);
        return redirect('/iap_membership_govprf1')->with('success','Master Degree Document uploaded successfully');
    }

    public function iap_membership_govprf1(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_govprf1',compact('member'));
    }

    public function iap_membership_govprf1_doc(Request $request){   
        $data = [];
        $user_id = Auth::user()->id;
        $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        $request->validate([
            'gov_proof' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        if($request->has('gov_proof')){
            $data['gov_proof'] = file_upload($request->file('gov_proof'),'service/documents','gov_proof',$member2);  
        }
        
        $member->update($data);
        $doc_status = update_doc_status();
        return redirect('/iap_membership_govprf2')->with('success','Goverment proof Document uploaded Successfully.');
    }

    public function iap_membership_govprf2(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_govprf2',compact('member'));
        
    }

    public function iap_membership_govprf2_doc(Request $request){   
        $data = [];
        $user_id = Auth::user()->id;
        $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        $request->validate([
            'gov_proof1'=> 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        if($request->has('gov_proof1')){
            $data['gov_proof1'] = file_upload($request->file('gov_proof1'),'service/documents','gov_proof1',$member2);
        } 
        $member->update($data);
        $doc_status = update_doc_status();
        return redirect('/iap_membership_other')->with('success','Goverment proof Document uploaded Successfully.');
    }

    public function iap_membership_other(){
        $member = Member::where('user_id',Auth::user()->id)->first();
        return view('documents.iap_membership_other',compact('member'));    
    }

    public function iap_membership_other_doc(Request $request){  
        $data = [];
        $user_id = Auth::user()->id;
        $member = Member::where('user_id',$user_id)->first();
        $member2 = [];
        $request->validate([
            'any_other_doc' => 'required|mimes:jpeg,png,jpg|max:2048'
            ]); 
        if($request->has('any_other_doc')){
            $data['any_other_doc'] = file_upload($request->file('any_other_doc'),'service/documents','any_other_doc',$member2);
        } 

        $member->update($data);

        //$doc_status = update_doc_status();

        // $userService = UserService::where('user_id',$user_id)->first();

        // $message = [
        //     'id'     => $userService->id,
        //     'title'  => 'Member Applied Serivce',
        //     'message'=> member_name($member).' member service applied.',
        //     'link'   => '/approval/service_request',
        // ];

        // $users = User::whereRoleIs('member_admin')->get();
        // Notification::send($users, new NotifyMessage($message));
        return redirect('/home')->with('success','All Document uploaded Successfully , Please wait for approval to start service selection.');

        //return redirect('/service')->with('success','We sent your request to iap member for approval after approval we will sent payment mail.');
    }

    //Document Upload End

    public function document_upload($request,$data,$member=[]){

        if($request->has('address_proof_doc')){
            $request->validate([
                'address_proof_type' => 'required|not_in:""'
            ]);

            $data['address_proof_doc'] = file_upload($request->file('address_proof_doc'),'service/documents','address_proof_doc',$member);
            $data['address_proof_type'] = $request->address_proof_type;
        }


        if($request->has('signature')){
            $data['signature'] = file_upload($request->file('signature'),'service/memberimages','signature',$member);
        }

        if($request->has('photo')){
            $data['photo'] = file_upload($request->file('photo'),'service/memberimages','photo',$member);
        }

        if($request->has('ten_doc')){
            $data['ten_doc'] = file_upload($request->file('ten_doc'),'service/documents','ten_doc',$member);
        }else{
        	$data['ten_doc'] = null;
        }

        if($request->has('twelve_doc')){
            $data['twelve_doc'] = file_upload($request->file('twelve_doc'),'service/documents','twelve_doc',$member);
        }else{
        	$data['twelve_doc'] = null;
        }

        if($request->has('internship_doc')){
            $data['internship_doc'] = file_upload($request->file('internship_doc'),'service/documents','internship_doc',$member);
        }else{
            $data['internship_doc'] = null;
        }

        if($request->has('bpt_doc')){
            $data['bpt_doc'] = file_upload($request->file('bpt_doc'),'service/documents','bpt_doc',$member);
        }else{
        	$data['bpt_doc'] = null;
        }

        if($request->has('mpt_doc')){
            $data['mpt_doc'] = file_upload($request->file('mpt_doc'),'service/documents','mpt_doc',$member);
        }else{
        	$data['mpt_doc'] = null;
        }
        
        if($request->has('gov_proof')){
            $data['gov_proof'] = file_upload($request->file('gov_proof'),'service/documents','gov_proof',$member);
        }else{
            $data['gov_proof'] = null;
        }

        if($request->has('gov_proof1')){
            $data['gov_proof1'] = file_upload($request->file('gov_proof1'),'service/documents','gov_proof1',$member);
        }else{
            $data['gov_proof1'] = null;
        }

        if($request->has('any_other_doc')){
            $data['any_other_doc'] = file_upload($request->file('any_other_doc'),'service/documents','any_other_doc',$member);
        }
        else{
            $data['any_other_doc'] = null;
        }

        if($request->service_id == '14'){
            if($request->has('iap_certificate')){
	            $data['iap_certificate'] = file_upload($request->file('iap_certificate'),'service/documents','iap_certificate',$member);
	        }
        }


        return $data;
    }

	public function qualification_add($data){

		$user_id = Auth::user()->id;
		$status = 'P';
		$qualification = [];
		if($data['ten_doc'] !=null){
			$qualification[]=[
				'qual_catg_code' => '1',
				'qual_catg_desc' => '10th',
                'doc_url'        => $data['ten_doc']         
			];   
		}
		if($data['twelve_doc'] !=null){
            $qualification[]=[
				'qual_catg_code' => '2',
				'qual_catg_desc' => '12th',
                'doc_url'        => $data['twelve_doc']         
			];
        }
        if($data['internship_doc'] !=null){
            $qualification[]=[
                'qual_catg_code' => '3',
                'qual_catg_desc' => 'Internship Certificate',
                'doc_url'        => $data['internship_doc']        
            ];
        }
        if($data['bpt_doc'] !=null){
            $qualification[]=[
				'qual_catg_code' => '4',
				'qual_catg_desc' => 'Under Graduate',
                'doc_url'        => $data['bpt_doc']        
			];
        }

        if($data['mpt_doc'] !=null){
            $qualification[]=[
				'qual_catg_code' => '5',
				'qual_catg_desc' => 'Master',
                'doc_url'        => $data['mpt_doc']        

			];
        }

        foreach ($qualification as $key => $value) {
            $qual = [
                'user_id'       => $user_id,
                'status'        => 'A',
                'qual_catg_code'=> $value['qual_catg_code'],
                'qual_catg_desc'=> $value['qual_catg_desc'],
                'doc_url'       => $value['doc_url']

            ];
            MemberQual::create($qual);
        }
      

	}

    public function member_document_show(){
    	// dd(request()->file_path);
		return Storage::download('public/'.request()->file_path);	
	}

    public function photo_id_card($id){
    	$service = Service::find($id);
        $member = Member::where('user_id',Auth::user()->id)->first();
        if($member->approval !='0'){
    	   return view('admin::services.forms.photo_id_card',compact('service','member'));
        }else{
            $message = [
                'id'     => $service->id,
                'title'  => 'Member Want to apply service.',
                'message'=> member_name($member)." member want to apply ".$service->name .". Verify user profile after than user apply service other than user can't apply our services.",
                'link'   => '/approval/profile',
            ];

            $users = User::whereRoleIs('member_admin')->get();
            Notification::send($users, new NotifyMessage($message));

            return redirect()->back()->with('warning','Your profile is not approved by IAP. we will sent profile approval message to IAP Admin');

        }
	}

    public function photo_id_card_store(Request $request){

       

        $member = Member::where('user_id',Auth::user()->id)->first();

        if($member->iap_certificate ==''){
            $request->validate([
                'iap_certificate' =>'required|mimes:jpeg,png,jpg,pdf|max:1024',
                'iap_no'        => 'required'
            ]);
            $data['approval'] = '0';
        }
        if($request->has('iap_certificate')){
            $data['iap_certificate'] = file_upload($request->file('iap_certificate'),'service/documents','iap_certificate',$member);
            $member->update($data);
        }

        $this->service_create($request,$member);

        return redirect('/service')->with('success','We sent your request to iap member for approval after approval we will sent payment mail.');

    }

        public function iap_certificate_form($id){
        $service = Service::find($id);
        $member = Member::where('user_id',Auth::user()->id)->first();
        if($member->approval !='0'){
           return view('admin::services.forms.iap_certificate_form',compact('service','member'));
        }else{
            $message = [
                'id'     => $service->id,
                'title'  => 'Member Want to apply service.',
                'message'=> member_name($member)." member want to apply ".$service->name .". Verify user profile after than user apply service other than user can't apply our services.",
                'link'   => '/approval/profile',
            ];

            $users = User::whereRoleIs('member_admin')->get();
            Notification::send($users, new NotifyMessage($message));

            return redirect()->back()->with('warning','Your profile is not approved by IAP. we will sent profile approval message to IAP Admin');

        }
    }

    public function iap_certificate_form_store(Request $request){

       $member = Member::where('user_id',Auth::user()->id)->first();
        if($member->iap_certificate ==''){
            $request->validate([
                'iap_certificate' =>'required|mimes:jpeg,png,jpg,pdf|max:1024',
                'iap_no'        => 'required'
            ]);
            $data['approval'] = '0';
        }
        if($request->has('iap_certificate')){
            $data['iap_certificate'] = file_upload($request->file('iap_certificate'),'service/documents','iap_certificate',$member);
            $member->update($data);
        }
        $this->service_create($request,$member);
        return redirect('/service')->with('success','We sent your request to iap member for approval after approval we will sent payment mail.');

    }

    public function service_create($request,$member){
        $userService =UserService::create([
            'user_id'   => Auth::user()->id,
            'service_id' => $request->service_id,
        ]);
        if($member->ten_doc !=null && $member->twelve_doc !=null && $member->internship_doc !=null && $member->bpt_doc !=null && $member->gov_proof !=null && $member->gov_proof1 !=null && $member->any_other_doc !=null){
        $message = [
            'id'     => $userService->id,
            'title'  => 'Member Applied Serivce',
            'message'=> member_name($member).' member service applied.',
            'link'   => '/approval/service_request',
        ];

        $users = User::whereRoleIs('member_admin')->get();
        Notification::send($users, new NotifyMessage($message));
       }
    }


    public function invoice_show(){
       $test = 'test-invoice';
       $iap = DB::table('iap_mast')->first();
       $invoice = Invoice::with('member.cities','member.states')->where('user_id',Auth::user()->id)->first();
        return view('admin::invoices.invoice_show',compact('iap','invoice'));
        
    }







    // public function payment_now($id){
        
    //     $userservice = UserService::where('user_id',$id)->first();
    
    //     $service = Service::find($userservice->service_id);
    //   // return $service;
    //     $data = [];
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
    //     // return $response;

    //     return redirect($response['paypal_link']);

    //   return $userservice;
    // }

    
}
