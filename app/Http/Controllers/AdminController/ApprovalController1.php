<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Member\Entities\MemberQual;
use Modules\Member\Entities\Member;
use App\Notifications\NotifyMessage;
use Illuminate\Support\Facades\Notification;
use App\User;
use Modules\Member\Entities\UserSpec;
use App\Models\UserService;
use App\Mail\AllMail;
use App\Mail\ApproveMail;
use App\Mail\IAPMail;
use Mail;
class ApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile(){
        $members = Member::where('approval','0')->get();
        return view('admin::approval.profile',compact('members'));
    }

    public function profile_show($id){
        // $qualifications = 
        $member = Member::with('college')->where('user_id',$id)->first();
        return view('admin::approval.profile_show',compact('member'));
    }

    public function profile_approve($id){
        $member = Member::find($id);
        $member->approval = '1';
        $member->reason = null;
        $member->save();

        $user = User::find($member->user_id);
        $message = [
            'id'     => $member->user_id,
            'title'  => 'Physiotherapy approved your profile updation.',
            'message'=> member_name($member).' profile approved successfully.',
            'link'   => '/member',
        ];
        $user->notify(new NotifyMessage($message));

        return redirect('approval/profile')->with('success','Member qualification approved successfully');
    }

    public function profile_decline(Request $request){

        $member = Member::find($request->id);
        $member->approval = '0';
        $member->reason = $request->reason;
        $member->save();       

        $user = User::find($member->user_id);
        $message = [
            'id'     => $member->user_id,
            'title'  => 'Physiotherapy declined your profile updation.',
            'message'=> member_name($member).' profile updation declined.',
            'link'   => '/member',
        ];
        $user->notify(new NotifyMessage($message));
        return redirect('approval/profile')->with('success','Member profile updation declined successfully');
    }


    public function qualifications(){
    	$member_ids = MemberQual::where('status','P')->distinct()->pluck('user_id');
    	$members = Member::whereIn('user_id',$member_ids)->get(); 
		return view('admin::approval.qualification',compact('members'));
    }

    public function qualification_show($id){
    	$qualifications = MemberQual::where('status','P')->where('user_id',$id)->get();
  		return view('admin::approval.qualification_show',compact('qualifications'));
    }
    public function qualification_approve($id){
    	$qual = MemberQual::find($id);
    	$qual->status = 'A';
        $qual->reason = null;
    	$qual->save();

        $this->qual_approved_message($qual);

    	return redirect()->back()->with('success','Member qualification approved successfully');
    }
    public function qualification_approve_all(Request $request){
        MemberQual::whereIn('id',$request->ids)->update(['status' => 'A','reason' => null]);
        $quals = MemberQual::whereIn('id',$request->ids)->get();
        foreach ($quals as $qual) {
            $this->qual_approved_message($qual);
        }

        return 'Member qualification approved successfully';

    }

    public function qualification_decline(Request $request){
        $qual = MemberQual::find($request->id);
        $qual->update(['status' => 'D','reason' => $request->reason]);
        $this->qual_declined_message($qual);
        return redirect()->back()->with('success','Member qualification declined successfully');
    }

    public function qualification_decline_all(Request $request){

        MemberQual::whereIn('id',$request->ids)->update(['status' => 'D', 'reason' => $request->reason ]);
        $quals = MemberQual::whereIn('id',$request->ids)->get();

        foreach ($quals as $qual) {
            $this->qual_declined_message($qual);
        }
      
        return 'Member qualification declined successfully';
    }

    public function qual_approved_message($qual){
        $user = User::find($qual->user_id);
        $message = [
            'id'     => $qual->user_id,
            'title'  => 'Physiotherapy approved your qualification.',
            'message'=> $qual->qual_catg_desc.' qualification approved successfully.',
            'link'   => '/qualification',
        ];

        $user->notify(new NotifyMessage($message));
    }

    public function qual_declined_message($qual){
        $user = User::find($qual->user_id);
            $message = [
                'id'     => $qual->user_id,
                'title'  => 'Physiotherapy declined your qualification.',
                'message'=> $qual->qual_catg_desc.' qualification declined contact physiotherapy team.',
                'link'   => '/qualification',
            ];
        $user->notify(new NotifyMessage($message));
    }


    public function specialization(){
        $member_ids = UserSpec::where('status','P')->distinct()->pluck('user_id');
        $members = Member::whereIn('user_id',$member_ids)->get(); 
        // return $members;
        return view('admin::approval.specialization',compact('members'));
    }
    public function specialization_show($id){
        // return $id;
        $specs = UserSpec::with('specializations')->where('status','P')->where('user_id',$id)->get();
        // return $specs;
        $user_id = $id;
        return view('admin::approval.specialization_show',compact('specs','user_id'));

    }
    public function specialization_approve($id){
        $ids = explode(',', $id);
        
        UserSpec::where('user_id',$ids[1])->where('specialization_id',$ids[0])->update(['status' => 'A','reason' => null]);
        $spec = UserSpec::with('specializations')->where('user_id',$ids[1])->where('specialization_id',$ids[0])->first();
     
        $this->spec_approved_message($spec);
        
        return redirect()->back()->with('success','Member specialization approved successfully');
    
    }

    public function specialization_approve_all(Request $request){
      
        UserSpec::where('user_id',$request->user_id)->whereIn('specialization_id',$request->ids)->update(['status' => 'A','reason' => null]);     
       
        $specs = UserSpec::with('specializations')->where('user_id',$request->user_id)->whereIn('specialization_id',$request->ids)->get();

        foreach ($specs as $spec) {
            $this->spec_approved_message($spec);
        }

        return 'Member specialization approved successfully';

    }

    public function specialization_decline(Request $request){
       
        UserSpec::where('user_id',$request->user_id)->where('specialization_id',$request->id)->update(['status' => 'D','reason' => $request->reason]);
    
        $spec = UserSpec::with('specializations')->where('user_id',$request->user_id)->where('specialization_id',$request->id)->first();

        $this->spec_declined_message($spec);

        return redirect()->back()->with('success','Member specialization declined successfully');
    }  

    public function specialization_decline_all(Request $request){
        UserSpec::where('user_id',$request->user_id)->whereIn('specialization_id',$request->ids)->update(['status' => 'D','reason' => $request->reason]);      
     
        $specs = UserSpec::with('specializations')->where('user_id',$request->user_id)->whereIn('specialization_id',$request->ids)->get();

        foreach ($specs as $spec) {
            $this->spec_declined_message($spec);
        }
      
        return 'Member qualification declined successfully';
    }

    public function spec_approved_message($spec){
        $message = [
            'id'     => $spec->user_id,
            'title'  => 'Physiotherapy approved your specialization.',
            'message'=> $spec->specializations->name.' specialization approved successfully.',
            'link'   => '/specialization',
        ];
        sent_message($spec->user_id,$message);
        
    }

    public function spec_declined_message($spec){
     
        $message = [
            'id'     => $spec->user_id,
            'title'  => 'Physiotherapy declined your specialization.',
            'message'=> $spec->specializations->name.' specialization declined contact physiotherapy team.',
            'link'   => '/specialization',
        ];
        sent_message($spec->user_id,$message);
    }
    public function service_request($status =null,$payment_status = null){    
        // return $status;
        $services = UserService::with(['service','member']);
        if($status == null || $payment_status == null){
            $status = 'P';
            $payment_status = '0';

           $services =  $services->where('status',$status)->orWhere('payment_status',$payment_status);
        }else{
            $status = $status;
            $payment_status = $payment_status;
            $services = $services->where('status',$status)->where('payment_status',$payment_status);
            if($status == 'A'){
               $services = $services->where('payment_id',null);
            }
        }


       $services =  $services->orderBy('id','desc')->get();
        // dd($services);
        return view('admin::approval.services.service_request',compact('services'));
    }
    public function service_request_filter(Request $request){      
        $status = $request->status; 
        $service_status = $request->service_status; 
        $payment_status = $request->payment_status; 

        // return $request->all();
        $services = UserService::orderBy('id','desc');

        if($service_status !='all'){
            $services->where('status',$service_status);
        }

        // $services = $services->where('payment_status','0');

        if($payment_status == 'all'){
           $services = $services->where('payment_status','0');
        }else if($payment_status == '1'){
             $services->where('payment_status','0')->where('payment_id',null);
        }else{
             $services->where('payment_status','0')->whereNotNull('payment_id');
        }

        // dd($services->get());

        if($status == 'all'){
            $services = $services->with(['service','member']);
        }else{
            // return $status;
            $services = $services->whereHas('member',function($q) use($status){
                $q->where('old_or_new',$status);
            })->with(['service','member']);
        }


        $services = $services->get();

    
        return view('admin::approval.services.service_req_table',compact('services'));
    }
    public function service_show($id){        
        $service = UserService::with(['service','member'])->where('id',$id)->first();
       // return $service;
        return view('admin::approval.services.show_service',compact('service'));
    }

    public function service_approve(Request $request){

       $userservice =  UserService::find($request->id);
       $user = User::find($userservice->user_id);
       // return $userservice->service_id;
       if($userservice->service_id !='14'){
            $data = [
                'status' => 'A',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ];

            if($userservice->old_or_new =='1'){
                $data['old_or_new'] = '1';
            }

            $userservice->update($data);


            $message = [
                'id'        => $request->id,
                'title'     => 'IAP admin approve your service',
                'message'   => 'Check your mail & follow the next process of service payment.',
                'link'       => '/service'
            ];
            Mail::to($user->email)->send(new ApproveMail());
       }else{
            $member = Member::where('user_id',$userservice->user_id)->first();
            $member->update(['status' => 'A']);

            $userservice->update(['status' => 'A','start_date' => $request->start_date,'end_date' => $request->end_date,'payment_id' => 'default','payment_status' => '1','old_or_new' => '1']);  


            $message = [
                'id'        => $request->service_id,
                'title'     => 'IAP approve your service.',
                'message'   => 'IAP sent confirmation message on your mail.',
                    'link'       => '/service'
            ];

            $mail = [
                'name' => member_name($member),
                'iap_no' => $member->iap_no,
            ];

            Mail::to($user->email)->send(new IAPMail($mail));
       }

        sent_message($userservice->user_id,$message);
        return 'Member service active';
    }
    public function service_decline(Request $request){
        $userservice =  UserService::find($request->service_id);
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

        return redirect()->back()->with('success','Member service declined successfully');
    }
    public function payment_approve(Request $request){

        // return $request->all();
        $userservice =  UserService::find($request->service_id);

        $userservice->update(['payment_status' => '1']);
        $member = Member::where('user_id',$userservice->user_id)->first();
        $member->update(['status' => 'A','iap_no' => $request->iap_no]);

        $message = [
            'id'        => $request->service_id,
            'title'     => 'IAP admin approve your service payment',
            'message'   => 'IAP admin sent a payment confirmation mail and IAP number sent on your mail.',
            'link'       => '/service'
        ];

        sent_message($userservice->user_id,$message);

        $user = User::find($userservice->user_id);

        $mail = [
            'name' => member_name($member),
            'iap_no' => $request->iap_no,
        ];

        Mail::to($user->email)->send(new IAPMail($mail));

        return "Member payment apporved successfully and Iap number sent on member mail.";
   
    }  

    public function payment_declined(Request $request){

        return $request->all();
        $userservice =  UserService::find($request->service_id);
        $reason = $request->reason;

        $userservice->update(['payment_status' => '2','reason' => $reason]);

        $member = Member::where('user_id',$userservice->user_id)->first();

        // $member->update(['status' => 'A','iap_no' => $request->iap_no]);

        $message = [
            'id'        => $request->service_id,
            'title'     => 'IAP admin delined your service payment',
            'message'   =>  $reason,
            'link'      => '/service'
        ];

        sent_message($userservice->user_id,$message);

        $user = User::find($userservice->user_id);

        // $mail = [
        //     'name' => member_name($member),
        //     'iap_no' => $request->iap_no,
        // ];

        // Mail::to($user->email)->send(new IAPMail($mail));

        return "Member payment declined successfully and reason sent on member mail.";
   
    }


    public function assign_iap_no(Request $request){
       Member::where('user_id',$request->member_id)->update(['iap_no' => $request->iap_no]);

       return 'Member IAP Number assigned successfully';
    }
}
