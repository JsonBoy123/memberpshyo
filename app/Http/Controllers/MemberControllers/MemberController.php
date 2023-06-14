<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\ServiceFormController;
use Modules\Member\Entities\Member;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyMessage;
use App\Models\UserService;
use App\Models\Service;

class MemberController extends ServiceFormController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       // $countries = Country::pluck('country_name','country_code');
     
        $member = Member::with('college')->where('user_id',Auth::user()->id)->first();
        // return $member;
        return view('member::member.index',compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
         return $request->all();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //return "sdaasd";
        return view('member::member.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $member = Member::where('user_id',$id)->first();
        $userservice = UserService::where('user_id',$id)->first();
        $service = Service::find($userservice->service_id);
        return view('member::member.edit',compact('service','member'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $member = Member::find($id);
        $data = $this->iap_membership_validation($request);

        $request->validate([
            'address_proof_doc'  =>'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address_proof_type' => 'nullable|not_in:""',
            'gov_proof' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'gov_proof1'=> 'nullable|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'photo'     => 'nullable|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($request->has('photo')){
            $data['photo'] = file_upload($request->file('photo'),'service/memberimages','photo',$member);
        }

        if($request->has('signature')){
            $data['signature'] = file_upload($request->file('signature'),'service/memberimages','signature',$member);
        }

        if($request->has('address_proof_doc')){
            $request->validate([
                'address_proof_type' => 'required|not_in:""'
            ]);

            $data['address_proof_doc'] = file_upload($request->file('address_proof_doc'),'service/documents','address_proof_doc',$member);
            $data['address_proof_type'] = $request->address_proof_type;
        }

        if($request->has('gov_proof')){
            $data['gov_proof'] = file_upload($request->file('gov_proof'),'service/documents','gov_proof',$member);
        }

        if($request->has('gov_proof1')){
            $data['gov_proof1'] = file_upload($request->file('gov_proof1'),'service/documents','gov_proof1',$member);
        }
        if($request->has('any_other_doc')){
            $data['any_other_doc'] = file_upload($request->file('any_other_doc'),'service/documents','any_other_doc',$member);
        }

        $data['approval'] = '0';        
        $member->update($data);

        $message = [
            'id'     => $member->id,
            'title'  => 'Member update profile.',
            'message'=> $member->name.'user update profile .Verify member profile',
            'link'   => '/approval/profile',
        ];

        $users = User::whereRoleIs('member_admin')->get();
        Notification::send($users, new NotifyMessage($message));
        return redirect('/member')->with('success','We sent updation information to iap for apporval.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function member_photo(Request $request){
        return $request->all();
    }
}
