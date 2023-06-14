<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Documents;
use App\Models\CollegeMast;
use Illuminate\Support\Facades\Storage;
use Modules\Member\Entities\Member;
use Auth;
use App\Models\UserService;
use App\Models\Service;
use App\Models\Address;
use Modules\Member\Entities\MemberQual;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(member_old_or_new());
        // Auth::logout();
        // return redirect('/login');
        if(Auth::user()->hasRole('member_admin') || Auth::user()->hasRole('admin')){
            $members = Member::where('status','!=','D')->orderBy('id')->get();
            $total_members = count($members);
            $today_regis_members = collect($members)->where('regn_date',date('Y-m-d'))->count();
            $old_member = collect($members)->where('old_or_new','1')->count();
            $new_member = collect($members)->where('old_or_new','0')->count();
            $pending_member = collect($members)->where('status','P')->count();
            $active_member = collect($members)->where('status','A')->count();

            $services_pay = UserService::with(['service','member'])->where('status','A')->where('payment_status','0')->whereNotNull('payment_id')->orderBy('updated_at','desc')->get();

            $pending_for_service = UserService::where('status','P')->where('payment_status','0')->count();
            $pending_for_payment = UserService::where('status','A')->where('payment_status','0')->whereNull('payment_id')->count();
            // return $pending_for_approved;

            $total_services = Service::count();

              $members_applied_services = Member::has('applied_services')->with('applied_services')->where('status','!=','D')->count();
              $not_applied_services = Member::whereDoesntHave('applied_services')->with('applied_services')->where('status','!=','D')->count();
            // return $not_applied_services;

            // return $total_services;

            // $applied_ser_members = Member::with('applied_services')->has('applied_services')->where('status','A')->orderBy('regn_date', 'DESC')->count();
            // return $today_regis_members; 
            // return $members;
            return view('home',compact('total_members','today_regis_members','old_member','new_member','pending_member','active_member','services_pay','total_services','pending_for_service','pending_for_payment','members_applied_services','not_applied_services'));
        }
        
        return view('dashboard');
    }

    // country name for home page dashboard
    public function country_code_name(Request $request)
    {
        $country_code=$request->post('country_code');
        $country = Country::where('country_code',$country_code)->pluck('country_name');
        return response()->json($country);
    }

    public function membqual(){

        $user_id = Auth::user()->id;
        $qualifications = MemberQual::where('user_id', $user_id)->get();
        $count = count($qualifications);

        $table = '<table class="table table-bordered">
              <thead>
                 <tr>
                    <th>Qualification</th>
                    <th>Institution</th>
                    <th>Board</th>
                    <th>Passing Year</th>
                    <th>Passing %</th>
                    <th>Division</th>
                    <th>Document</th>
                 </tr>
              </thead>
              <tbody>';
              
            if($count >= 1 )
            {
                foreach($qualifications as $qual) 
                {
        
                     $qual_catg = $qual->qual_catg_desc;
                     $location = $qual->location;
                     $board = $qual->board;
                     $pass_year = $qual->pass_year;
                     $pass_marks = $qual->pass_marks;
                     $pass_division = $qual->pass_division;
                     $doc_url = $qual->doc_url;
                    
                 
                    $table .= '<tr>
                        <td>'.$qual_catg.'</td>
                        <td>'.$location.'</td>
                        <td>'.$board.'</td>
                        <td>'.$pass_year.'</td>
                        <td>'.$pass_marks.'</td>
                        <td>'.$pass_division.'</td>
                        <td><a href="storage/'.$doc_url.'" class="fa fa-eye" target="_blank"> preview</a></td>
                    </tr>';
                    
                }
            }
            else{
                
                $table .= '<tr>
                            <td colspan="7"><center>No Data Found</center></td>
                            
                        </tr>';
            }

         $table .= '</tbody>
        </table>';

        return $table;
    }

    public function membdocs(){
        $members = get_member_details();
        $gov_proof = $members->gov_proof;
        if($gov_proof == NULL){
           $gov_proof = '<span style="color:red"> Pending</span>' ;
        }else{
            $gov_proof = '<a href="storage/'.$members->gov_proof.'" class="fa fa-eye" target="_blank"> Preview</a>' ;
        }
        $gov_proof1 = $members->gov_proof1;
        if($gov_proof1 == NULL){
           $gov_proof1 = '<span style="color:red"> Pending</span>' ;
        }else{
            $gov_proof1 = '<a href="storage/'.$members->gov_proof1.'" class="fa fa-eye" target="_blank"> Preview</a>' ;
        }
        $any_other_doc = $members->any_other_doc;
        if($any_other_doc == NULL){
           $any_other_doc = '<span style="color:red"> Pending</span>' ;
        }else{
            $any_other_doc = '<a href="storage/'.$members->any_other_doc.'" class="fa fa-eye" target="_blank"> Preview</a>' ;
        }
 

        $table = '<table class="table table-bordered">
              <thead>
                 <tr>
                    <th>Doc Name</th>
                    <th>Status</th>
                    
                 </tr>
              </thead>
              <tbody>';
        
                     

                $table .= '<tr>
                    <td>'."Gov. Proof Doc".'</td>
                    <td>'.$gov_proof.'</td>
                </tr>';         
                             
                $table .= '<tr>
                    <td>'."Gov. Proof Doc1".'</td>
                    <td>'.$gov_proof1.'</td>
                 </tr>';

                 $table .= '<tr>
                    <td>'."Another Document".'</td>
                    <td>'.$any_other_doc.'</td>
                 </tr>';
           

         $table .= '</tbody>
        </table>';

        return $table;

    }

    public function states($country_code){
        $states = State::where('country_code',$country_code)->get();
        return response()->json($states);
    }
    public function cities($state_code){
        $cities = City::where('state_code',$state_code)->get();
        return response()->json($cities);
    }

    public function doc_download($id){
        $document = Documents::find($id);
 
        return Storage::download('public/'.$document->disk.'/'.$document->file_name);
    }

    public function notification_read($id){
        $notification = auth()->user()->unreadNotifications->where('id',$id)->first();
        $notification->markAsRead();
        // return "sdfsdf";
        return redirect($notification->data['link']);

    }

    public function membership()
    {     
        $member = Member::where('user_id',Auth::user()->id)->first();
        $country = Country::get();
        return view('profile.membership',compact('member','country'));
    }

    public function college_dropdown(Request $request)
    {
        $a = $request->post('a');
        $college = CollegeMast::where('college_code',$a)->pluck('college_name');
        return response()->json($college);
    }

    public function membership_store(Request $request)
    {      
        $data = $this->membership_validation($request);
        $member = Member::where('user_id',Auth::user()->id)->first();
        $members = [];

        if($member->old_or_new =='1'){
            $request->validate([
                'iap_no'           => 'required',
                'iap_certificate'  => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $data['iap_no'] = 'L-'.$request->iap_no;
        }

        $request->validate([
            'address_proof_doc' => 'required|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'required|mimes:jpeg,png,jpg|max:2048',
            'photo'     => 'required|mimes:jpeg,png,jpg|max:2048'
        ]); 

        if($request->has('address_proof_doc')){
            $data['address_proof_doc'] = file_upload($request->file('address_proof_doc'),'service/memberimages','address_proof_doc',$members);
        }

        if($request->has('signature')){
            $data['signature'] = file_upload($request->file('signature'),'service/memberimages','signature',$members);
        }

        if($request->has('photo')){
            $data['photo'] = file_upload($request->file('photo'),'service/memberimages','photo',$members);
        }
        $data['approval'] = '1';      
        $data['user_id'] = Auth::user()->id;
        //return $data;die;
        
        $member->update($data);

        return redirect('/membership_address')->with('success','Please add address details');  
    }


    public function membership_validation($request){
        $data = $request->validate([
            'college_code'          => 'nullable',
            'college_name'          => 'required',
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
        
        $data['dob'] = date('Y-m-d',strtotime($request->dob));
        // if($request->old_or_new !='1'){
        //        $request->validate([
        //             'college_code' => 'required|not_in:""',
        //             'college_name' => 'required'
        //         ]);
        //         $data['college_code'] = $request->college_code;
        //         $data['college_name'] = $request->college_name;
        // }else{
        //        $request->validate([
        //             'college_code' => 'required|not_in:""'
        //         ]);
        //         $data['college_code'] = $request->college_code;
        // }
         return $data;
    }

    // Create show page
    public function membershipAddress()
    {   //return $user_id = Auth::user()->id; 
        //$country = Country::all();
        $state = State::get()->pluck('state_name','state_code');
        $country = Country::get()->pluck('country_name','country_code');
        
        return view('profile.address',compact('country','state'));
    }

    public function country_dropdown(Request $request)
    {
        $cid=$request->post('cid');
        $state = State::where('country_code',$cid)->pluck('state_name','state_code');
        return response()->json($state);
    }

    public function state_dropdown(Request $request)
    {
        $sid=$request->post('sid');
        $city = City::where('state_code',$sid)->pluck('city_name','city_code');
        return response()->json($city);
        // $html='<option value="">City</option>';
        // foreach ($city as $value) {
        //     $html.='<option value="'.$value->city_code.'">'.$value->city_name.'</option>';
        // }
        // echo $html;
    }

    public function country_dropdown1(Request $request)
    {
        $cid1=$request->post('cid1');
        $state1 = State::where('country_code',$cid1)->pluck('state_name','state_code');
        return response()->json($state1);
    }

    public function state_dropdown1(Request $request)
    {
        $sid1=$request->post('sid1');
        $city1 = City::where('state_code',$sid1)->pluck('city_name','city_code');
        return response()->json($city1);
    }

    //click check bok of state
    public function click_state_box(Request $request)
    {
        $click_state=$request->post('click_state');
        $state1= State::where('state_code',$click_state)->pluck('state_name','state_code');
        return response()->json($state1);
    }
    public function click_city_box(Request $request)
    {
        $click_city=$request->post('click_city');
        $state1= City::where('city_code',$click_city)->pluck('city_name','city_code');
        return response()->json($state1);
    }

    // Create insert page form 
    public function store_address(Request $request)
    {
        // return $request;
        // die();
        //dd($request->all());
        $user_id = Auth::user()->id;

        $addressDetail = new Address;

        $addressDetail = $request->validate([
            
            'addr'        => 'required',
            'country'     => 'required',
            'state_code'       => 'required',
            'city_code'        => 'required',
            'zip'         => 'required',
            
        ]);  

        $country_name = Country::where('country_code',$request->country)->first()->country_name;
        $state_name = State::where('state_code',$request->state_code)->first()->state_name;
        $city_name = City::where('city_code',$request->city_code)->first()->city_name;

         $paddress['user_id'] = Auth::user()->id;
         $paddress['address_type'] = 'P';
         $paddress['city_code'] = $request->city_code;
         $paddress['city_name'] = $city_name;
         $paddress['state_code'] = $request->state_code;
         $paddress['state_name'] = $state_name;
         $paddress['country_code'] = $request->country;
         $paddress['country_name'] = $country_name;
         $paddress['zip'] = $request->zip;
         $paddress['addr'] =  $request->addr;



        $addressDetail2 = $request->validate([
            
            'addr1'        => 'required',
            'country1'     => 'required',
            'state_code1'  => 'required',
            'city_code1'   => 'required',
            'zip1'         => 'required',
            
        ]);

        $country_name = Country::where('country_code',$request->country1)->first()->country_name;
        $state_name = State::where('state_code',$request->state_code1)->first()->state_name;
        $city_name = City::where('city_code',$request->city_code1)->first()->city_name;

         $caddress['user_id'] = Auth::user()->id;
         $caddress['address_type'] = 'C';
         $caddress['city_code'] = $request->city_code1;
         $caddress['city_name'] = $city_name;
         $caddress['state_code'] = $request->state_code1;
         $caddress['state_name'] = $state_name;
         $caddress['country_code'] = $request->country1;
         $caddress['country_name'] = $country_name;
         $caddress['zip'] = $request->zip1;
         $caddress['addr'] =  $request->addr1;

        // $data = $request->validate([
        //     'tx_flag'           => 'nullable',
        //     'address_proof_doc' =>'required|image|mimes:jpeg,png,jpg|max:2048', 
        //     'address_proof_type' => 'required|not_in:""'
        // ]);

        Address::create($paddress);
        Address::create($caddress);
        
        return redirect('/iap_membership_tenth')->with('success','Please add qualification details');
        
    }
    
    // update page show
    public function membershipAddressUpdate()
    { 
        // return $user_id = Auth::user()->id; 
        $memberP = Address::where('user_id',Auth::user()->id)->where('address_type','=','P')->first();
        $memberC = Address::where('user_id',Auth::user()->id)->where('address_type','=','C')->first();        
        $country = Country::get();
        $states = State::get();
        $cities = City::get();

        return view('profile.Update_address',compact('memberP','memberC','country','states','cities'));
    }

    public function update_address(Request $request)
    {   // return $user_id = Auth::user()->id; 
        //return $request;
        $addressP = Address::where('user_id',(Auth::user()->id))->where('address_type','P')->first();

        $paddress2 = $request->validate([
            'addr'        => 'required',
            'country'     => 'required',
            'state_code'  => 'required',
            'city_code'   => 'required',
            'zip'         => 'required',
        ]);  

        $country_name = Country::where('country_code',$request->country)->first()->country_name;
        $state_name = State::where('state_code',$request->state_code)->first()->state_name;
        $city_name = City::where('city_code',$request->city_code)->first()->city_name;

        $paddress['city_code'] = $request->city_code;
        $paddress['city_name'] = $city_name;
        $paddress['state_code'] = $request->state_code;
        $paddress['state_name'] = $state_name;
        $paddress['country_code'] = $request->country;
        $paddress['country_name'] = $country_name;
        $paddress['zip'] = $request->zip;
        $paddress['addr'] =  $request->addr;

        Address::where('user_id',Auth::user()->id)->where('address_type','P')->update($paddress);

        $addressC = Address::where('user_id',(Auth::user()->id))->where('address_type','C')->first();

        $caddress2 = $request->validate([
            'addr1'        => 'required',
            'country1'     => 'required',
            'state_code1'  => 'required',
            'city_code1'   => 'required',
            'zip1'         => 'required',
        ]);  

        $country_name1 = Country::where('country_code',$request->country1)->first()->country_name;
        $state_name1 = State::where('state_code',$request->state_code1)->first()->state_name;
        $city_name1 = City::where('city_code',$request->city_code1)->first()->city_name;

        $caddress['city_code'] = $request->city_code1;
        $caddress['city_name'] = $city_name1;
        $caddress['state_code'] = $request->state_code1;
        $caddress['state_name'] = $state_name1;
        $caddress['country_code'] = $request->country1;
        $caddress['country_name'] = $country_name1;
        $caddress['zip'] = $request->zip1;
        $caddress['addr'] =  $request->addr1;
        

        Address::where('user_id',Auth::user()->id)->where('address_type','C')->update($caddress);
       
        return back()->with('success','Data update successfully');

    }

    public function CollegeNameTransferData()
    {
        $data = CollegeMast::where('college_code',$request->a)->first()->college_name;

        return json_encode(array('$data'));
    }





}

