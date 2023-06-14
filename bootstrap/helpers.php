<?php
 
use App\Models\Documents;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\MemberQual;
use Modules\Member\Entities\Member;
use Modules\Admin\Entities\Article\Articles;
use Modules\Category\Entities\Category;
//use Auth;
use App\Models\CollegeMast;
use App\Models\UserService;
use App\Models\Service;
use App\Models\Address;
use App\Role;
use App\User;
use App\Notifications\NotifyMessage;
use Illuminate\Support\Facades\Notification;

const GENDER = [
    ''  => 'Select Gender',
    'M' => 'Male',
    'F' => 'Female',
    'O' => 'Other',
];

const RELIGION = [
    1 => 'Hindu',
    2 => 'Islam',
    3 => 'Cristian',
    4 => 'Buddhist',
    5 => 'Other',
];

const MARITALSTATUS = [
    'S' => 'Single',
    'M' => 'Married',
    'W' => 'Widowed',
    'D' => 'Divorced',
];

const STATUS = [
    'A' => 'Active',
    'P' => 'Pending',
    'S' => 'Suspend',
];

const BLOOD_GROUP = [
    '' => 'Select Blood Group',
    1 => 'A+',
    2 => 'O+',
    3 => 'B+',
    4 => 'AB+',
    5 => 'A-',
    6 => 'O-',
    7 => 'B-',
    8 => 'AB-',
];
const RELATION_TYPE = [
    '' => 'Select Relation',
    'F' => 'Father',
    'M' => 'Mother',
    'H' => 'Husband',
    'G' => 'Guardian',
];
const QUALIFICATION_TYPE = [
   '' => 'Select Qualification Name',
   '10th' => '10th',
   '12th' => '12th',
   'btp' => 'B.P.T.',
   'mpt' => 'M.P.T.',
];
const ADDRESS_PROOF_TYPE = [
    '' => 'Select Address Proof',
    '1' => 'Aadhaar Card',
    '2' => 'Voter ID Card',
    '3' => 'Driving Licenese',
    '4' => 'Pan Card',
];

//on hold mode some few changes 
if (!function_exists('document_save')) {
    function document_save($request,$model,$user_id,$folder_name){

        $file = $request->file('qual_doc');
        $filename =  time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('public/'.date('Y').$folder_name, $filename);
        $path = date('Y').$folder_name;

        $document = [
            'user_id'   => $user_id,
            'model_id'  => $model->id,
            'size'      => $file->getSize(),
            'meme_type' => $file->getMimeType(),
            'disk'      => $path,
            'file_name' => $filename,
            'name'      => basename($file->getClientOriginalName().'.'.$file->getClientOriginalExtension()),
            'model_type'=> class_basename($model),
        ];

        Documents::create($document);
    }
}

if (!function_exists('member_create')) {
    function member_create($user,$data){
        return  Member::create([
            'user_id'    => $user->id,
            'first_name' => $data['first_name'],
            'middle_name'=> $data['middle_name'],
            'last_name'  => $data['last_name'],
            'email'      => $user->email,
            'mobile'     => $user->phone,
            'regn_date'  => date('Y-m-d', strtotime($user->created_at)),
            'old_or_new' => $data['status'],
            'iap_no'     => $data['iap_no'],
            'services'   => $data['services'],
        ]); 
    }
}


if (!function_exists('articles_fetch')) {
    function articles_fetch(){
        $articles = Articles::select('title','id','category_id','created','body','sefriendly')->where('status','1');
        return $articles;
    }
}

if (!function_exists('category_fetch')) {
    function category_fetch(){
        $categories = Category::where('type','category')->orderBy('order_num','ASC');
        return $categories;
    }
}

if (!function_exists('member_check')) {
    function member_check(){
        $member = Member::where('user_id',Auth::user()->id)->where('status','P')->first();
        // return $member;
        return !empty($member) ? true : false;
    }
}

if(!function_exists('tenth_check')){
    function tenth_check(){
        $data = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','1')->first(); 
        return $data;
    }     
}

if(!function_exists('twelve_check')){
    function twelve_check(){
        $data = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','2')->first(); 
        return $data;
    }     
}

if(!function_exists('intern_check')){
    function intern_check(){
        $data = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','3')->first(); 
        return $data;
    }     
}

if(!function_exists('under_check')){
    function under_check(){
        $data = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','4')->first(); 
        return $data;
    }     
}

if(!function_exists('post_check')){
    function post_check(){
        $data = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','5')->first(); 
        return $data;
    }     
}

if(!function_exists('address_check')){
    function address_check(){
        $data = Address::where('user_id',Auth::user()->id)->first(); 
        return $data;
    }     
}


if(!function_exists('service_check')){
    function service_check(){
        $service = UserService::where('user_id',Auth::user()->id)->first();        
        return $service;
    }     
}

if (!function_exists('country_name')) {
    function country_name($id){
      $country = Country::find($id);
      return $country->country_name;
    }
}
if (!function_exists('state_name')) {
    function state_name($id){
      $state =  State::find($id);
      return $state->state_name; 
    }
}
if (!function_exists('city_name')) {
    function city_name($id){
      $city =  City::find($id);
      return $city->city_name; 
     
    }
}
if (!function_exists('member_name')) {
    function member_name($member){
        
     return $member->first_name.($member->middle_name !=null ? ' '.$member->middle_name : '' )." ". $member->last_name;
     
    }
}
if (!function_exists('countries')) {
    function countries(){
       $countries = Country::pluck('country_name','country_code');
       $countries->prepend('Select Country','');
       return $countries;
     
    }
}


if (!function_exists('member_type')) {
    function member_type(){
       $roles = Role::whereNotIn('id',['1','3'])->pluck('display_name','id');
       $roles->prepend('Select member type','');
       return $roles;
     
    }
}

if (!function_exists('college_name_find')) {
    function college_name_find(){
       $roles = CollegeMast::where('college_code','=','college_name')->first()->college_name;
       return $roles;
     
    }
}


if (!function_exists('colleges')) {
    function colleges(){
        $colleges = CollegeMast::pluck('college_name','college_code');
        $colleges->prepend('Select IAP Member College','');
        return $colleges;
    }
}

if (!function_exists('file_upload')) {
    function file_upload($file,$folder,$field_name =null,$data = []){
        if(!empty($data) !=0){
            if($data->$field_name != null){
               Storage::delete('public/'.$data->$field_name);
            }
        }

        $name =  time().'_'.$file->getClientOriginalName();
        $file->storeAs('public/'.date('Y').'/'.date('M').'/'.$folder, $name);
        $path = date('Y').'/'.date('M').'/'.$folder.'/'.$name;
        return $path;

    }
}

if (!function_exists('get_services')) {
    function get_services(){
        $member_type =  Auth::user()->roles()->pluck('id'); 

        if(Auth::user()->hasRole('super_admin') =='1' || Auth::user()->hasRole('member_admin') == '1'  ){
            $services =  Service::with('member')->orderBy('status','DESC')->orderBy('line')->get();
        }else{
            $services = Service::with('member')->where('status','1')->whereIn('member_type',$member_type)->orderBy('line')->get();
        }
        return $services;
    }
}

if (!function_exists('sent_message')) {
    function sent_message($id,$message){
        $user = User::find($id);       
        $user->notify(new NotifyMessage($message));
    }
}

if(!function_exists('member_service_check')){
    function member_service_check(){
        $service = UserService::where('user_id',Auth::user()->id)->whereIn('service_id',['10','11','12','13','14'])->get();

        return count($service) !='0' ? false : true;
    }
}

if(!function_exists('file_name')){
    function file_name($docs){
        $file = explode('/', $docs);
        $doc = explode('_', $file[4]);
        return $doc[1];
    }
}

if(!function_exists('get_member_details')){
    function get_member_details(){
       return Member::where('user_id',Auth::user()->id)->first();
    }
}

if(!function_exists('get_member_address_p')){
    function get_member_address_p(){
       return Address::where('user_id',Auth::user()->id)->where('address_type','=','P')->first();
    }
}

if(!function_exists('get_member_address_C')){
    function get_member_address_C(){
       return Address::where('user_id',Auth::user()->id)->where('address_type','=','C')->first();
    }
}

if(!function_exists('update_doc_status')){
    function update_doc_status(){
        $user_id = Auth::user()->id;
        $member_doc = Member::where('user_id',$user_id)->first();
        if($member_doc->gov_proof != null && $member_doc->gov_proof1 != null && $member_doc->any_other_doc != null){
              $service = $member_doc->services;
              $serviceid = substr($service,18,2);
              $sid = intval($serviceid);

              $service_mast = Service::where('id',$sid)->first();
           
            $userService =UserService::create([
            'user_id'   => $user_id,
            'service_id' =>  $sid,
            'charges' =>  $service_mast->charges,
            'tax_charges' =>  $service_mast->tax_charges,
            'tx_flag' =>  $member_doc->tx_flag,
           ]);
              
            $userServiceFind = UserService::where('user_id',$user_id)->first();

            $message = [
            'id'     => $userServiceFind->id,
            'title'  => 'Member Applied Serivce',
            'message'=> member_name($member_doc).' member service applied.',
            'link'   => '/approval/service_request',
           ];

           $users = User::whereRoleIs('member_admin')->get();
           Notification::send($users, new NotifyMessage($message));


        }
    }
}

if(!function_exists('doc_missing_notification')){
    function doc_missing_notification(){
        $member = get_member_details();
           // if($member->ten_doc == null){echo "10th Marksheet is not uploaded</br>";}
           // if($member->twelve_doc == null){echo "12th Marksheet is not uploaded</br>";}
           // if($member->internship_doc == null){echo "Internship Certificate is not uploaded</br>";}
           // if($member->bpt_doc == null){echo "Bachelor of Physiotherapy (B.P.T.) Document is not uploaded</br>";}
           if($member->gov_proof == null){echo "Any Goverment Proof Document is not uploaded</br>";}
           if($member->gov_proof1 == null){echo "Another Goverment Proof Document is not uploaded</br>";}
           if($member->any_other_doc == null){echo "Any Other Document is not uploaded</br>";}
    }
}



if(!function_exists('getIndianCurrency')){

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees Only' : '') . $paise;
}
}


