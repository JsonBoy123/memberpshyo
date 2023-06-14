<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Member\Entities\UserQual;
use Modules\Member\Entities\QualCatgMast;
use Modules\Member\Entities\MemberQual;
use Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Documents;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyMessage;

class QualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {  
        $qualifications = MemberQual::with('file')->where('user_id',Auth::user()->id)->get();
        // return $qualifications;
       
        return view('profile.qualification.index',compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $qual_catgs = QualCatgMast::all();

        return view('profile.qualification.create',compact('qual_catgs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request);

        $request->validate([
            'qual_doc'  => 'required|max:5120|mimes:jpeg,png,jpg,pdf'
        ]);

        $member_qual = MemberQual::where('qual_catg_code', $request->qual_catg_code)->where('user_id',Auth::user()->id)->first();

        $qualification = Member::where('');

        // return $member_qual;

        if($member_qual){
            return back()->with('warning','Qualification already    added');
        }else{

            if($request->has('qual_doc')){

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents');

              // document_save($request,$member,Auth::user()->id,'/qual_docs');
            }
            $member =  MemberQual::create($data);

            $message = [
                'id'     => Auth::user()->id,
                'title'  => 'Member added qualifications.',
                'message'=> Auth::user()->name.' added qualification.',
                'link'   => 'approval/qualification/'.Auth::user()->id,
            ];
           
            $users = User::whereRoleIs('member_admin')->get();

            Notification::send($users, new NotifyMessage($message));
           

            return redirect('/qualification')->with('success','Qualification added successfully');
            
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return $id;
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */

    public function edit($id)
    {
        $qual_catgs = QualCatgMast::all();
        $qualification = MemberQual::with('file')->where('id',$id)->first();

        return view('profile.qualification.edit',compact('qual_catgs','qualification'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $data = $this->validate($request);
        
        $member_qual = MemberQual::where('qual_catg_code', $request->qual_catg_code)->where('user_id',Auth::user()->id)->where('id', '!=' ,$id)->first();
      
        if($member_qual){

            return back()->with('warning','Qualification already added');
           
        }else{
        
            $member = MemberQual::find($id);

            // $qualification = MemberQual::with('file')->where('id',$id)->first();
            if($request->has('qual_doc')){
                // if($qualification->file){                           
                //     Storage::delete('public/'.$qualification->file->disk.'/'.$qualification->file->file_name);
                //     Documents::find($qualification->file->id)->delete();
                // }

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents','doc_url',$member);

            }
            $member->update($data);

                //document_save($request,$member,Auth::user()->id,'/qual_docs');
                $message = [
                    'id'     => Auth::user()->id,
                    'title'  => 'Member updated qualifications.',
                    'message'=> Auth::user()->name.' updated qualification.',
                    'link'   => 'approval/qualification/'.Auth::user()->id,
                ];

                $member->status = 'P';
                $member->save();
                $users = User::whereRoleIs('member_admin')->get();
                Notification::send($users, new NotifyMessage($message));              
            
            return redirect('/qualification')->with('success','Qualification updated successfully');
        }
    }

    public function destroy($id)
    {
        //
    }
    public function validate($request){
        $data =  $request->validate([
            'qual_catg_code' => 'required',
            'location' => 'required|min:4|max:191',
            'board'    =>  'min:4|max:191',            
            'pass_marks'   => 'required',
            'pass_year'     => 'required|integer|min:1900|max:'.date('Y'),
            'pass_division' => 'required|not_in:""',
        ]);

        $qual_catg = QualCatgMast::where('qual_catg_code',$request->qual_catg_code)->first(); 
        $data['user_id'] = Auth::user()->id;
        $data['qual_catg_desc'] = $qual_catg->qual_catg_desc;
        return $data;
    }

    public function qualification_reason($id){
        return MemberQual::find($id);
    }

    // insert 10th data form show
    public function tenth_qual_show()
    {
        return view('memberView.qualification.qualificationForms.tenth_qualification');
    }
     
    // insert 10th data form insert   
    public function tenth_qual_create(Request $request)
    {   

        $data = $this->validate($request);

        $request->validate([
            'qual_doc'  => 'required|max:5120|mimes:jpeg,png,jpg,pdf'
        ]);

        $member_qual = MemberQual::where('qual_catg_code', $request->qual_catg_code)->where('user_id',Auth::user()->id)->first();

        // return $member_qual;

        if($member_qual){
            return back()->with('warning','Qualification already added');
        }else{

            if($request->has('qual_doc')){

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents');

              // document_save($request,$member,Auth::user()->id,'/qual_docs');
            }
            $member =  MemberQual::create($data);

            $message = [
                'id'     => Auth::user()->id,
                'title'  => 'Member added qualifications.',
                'message'=> Auth::user()->name.' added qualification.',
                'link'   => 'approval/qualification/'.Auth::user()->id,
            ];
           
            $users = User::whereRoleIs('member_admin')->get();

            Notification::send($users, new NotifyMessage($message));
           
            return redirect('/twelve_qualification')->with('success','10th Qualification added successfully'); 
        }
    }

    // insert 12th data form show
    public function twelve_qual_show(){

        return view('memberView.qualification.qualificationForms.twelve_qualification');
    }

    // insert 12th data form insert  
    public function tweleve_qual_create(Request $request)
    {

        $data = $this->validate($request);

        $request->validate([
            'qual_doc'  => 'required|max:5120|mimes:jpeg,png,jpg,pdf'
        ]);

        $member_qual = MemberQual::where('qual_catg_code', $request->qual_catg_code)->where('user_id',Auth::user()->id)->first();

        // return $member_qual;

        if($member_qual){
            return back()->with('warning','Qualification already added');
        }else{

            if($request->has('qual_doc')){

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents');

              // document_save($request,$member,Auth::user()->id,'/qual_docs');
            }
            $member =  MemberQual::create($data);

            $message = [
                'id'     => Auth::user()->id,
                'title'  => 'Member added qualifications.',
                'message'=> Auth::user()->name.' added qualification.',
                'link'   => 'approval/qualification/'.Auth::user()->id,
            ];
           
            $users = User::whereRoleIs('member_admin')->get();

            Notification::send($users, new NotifyMessage($message));

            return redirect('/intern_qualification')->with('success','12th Qualification added successfully'); 
        }
    }

    // insert internship data form show
    public function intern_qual_show()
    { 

        return view('memberView.qualification.qualificationForms.intern_qualification');
    }

    // insert internship data form insert  
    public function intern_qual_create(Request $request)
    {

        $data = $this->validate($request);

        $request->validate([
            'qual_doc'  => 'required|max:5120|mimes:jpeg,png,jpg,pdf'
        ]);

        $member_qual = MemberQual::where('qual_catg_code', $request->qual_catg_code)->where('user_id',Auth::user()->id)->first();

        // return $member_qual;

        if($member_qual){
            return back()->with('warning','Qualification already added');
        }else{

            if($request->has('qual_doc')){

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents');

              // document_save($request,$member,Auth::user()->id,'/qual_docs');
            }

            $member =  MemberQual::create($data);

            $message = [
                'id'     => Auth::user()->id,
                'title'  => 'Member added qualifications.',
                'message'=> Auth::user()->name.' added qualification.',
                'link'   => 'approval/qualification/'.Auth::user()->id,
            ];
           
            $users = User::whereRoleIs('member_admin')->get();

            Notification::send($users, new NotifyMessage($message));

            return redirect('/bpt_qualification')->with('success','Internship Qualification added successfully'); 
        }
    }

    // insert Under Graduate data form show
    public function UG_qual_show()
    {        

        return view('memberView.qualification.qualificationForms.UG_qualification');
    }

    // insert Under Graduate data form insert
    public function UG_qual_create(Request $request)
    {  
        $data = $this->validate($request);

        $request->validate([
            'qual_doc'  => 'required|max:5120|mimes:jpeg,png,jpg,pdf'
        ]);

        $member_qual = MemberQual::where('qual_catg_code','4')->where('user_id',Auth::user()->id)->first();

        // return $member_qual;

        if($member_qual){
            return back()->with('warning','Qualification already added');
        }else{

            if($request->has('qual_doc')){

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents');

              // document_save($request,$member,Auth::user()->id,'/qual_docs');
            }
            $member =  MemberQual::create($data);

            $message = [
                'id'     => Auth::user()->id,
                'title'  => 'Member added qualifications.',
                'message'=> Auth::user()->name.' added qualification.',
                'link'   => 'approval/qualification/'.Auth::user()->id,
            ];
           
            $users = User::whereRoleIs('member_admin')->get();

            Notification::send($users, new NotifyMessage($message));

            return redirect('/mpt_qualification')->with('success','Qualification added successfully'); 
        }
    }

    // insert Master Graduate data form show
    public function PG_qual_show(Request $request)
    {

        return view('memberView.qualification.qualificationForms.PG_qualification');
    }

    // insert Master Graduate data form insert
    public function PG_qual_create(Request $request)
    {
        $data = $this->validate($request);

        $request->validate([
            'qual_doc'  => 'required|max:5120|mimes:jpeg,png,jpg,pdf'
        ]);

        $member_qual = MemberQual::where('qual_catg_code', $request->qual_catg_code)->where('user_id',Auth::user()->id)->first();

        // return $member_qual;

        if($member_qual){
            return back()->with('warning','Qualification already added');
        }else{

            if($request->has('qual_doc')){

                $data['doc_url'] = file_upload($request->file('qual_doc'),'service/documents');

              // document_save($request,$member,Auth::user()->id,'/qual_docs');
            }
            $member =  MemberQual::create($data);

            $message = [
                'id'     => Auth::user()->id,
                'title'  => 'Member added qualifications.',
                'message'=> Auth::user()->name.' added qualification.',
                'link'   => 'approval/qualification/'.Auth::user()->id,
            ];
           
            $users = User::whereRoleIs('member_admin')->get();

            Notification::send($users, new NotifyMessage($message));

            return redirect('/qualification')->with('success','Qualification added successfully'); 
        }
    }


    // update 10th data form show
    public function tenth_qual_update_show()
    {  // return $user = Auth::user()->id;
        $qualification = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','1')->first();

        return view('memberView.qualification.qualificationUpdate.tenth_qualification_update',compact('qualification'));
    }
    // update 10th form
    public function tenth_qual_update(Request $request,$id)
    {    $request->all();    
        $post = MemberQual::find($id);
        $post->location = $request->location;
        $post->board = $request->board;
        $post->pass_marks = $request->pass_marks;
        $post->pass_year = $request->pass_year;
        $post->pass_division = $request->pass_division;
        
        if($request->hasFile('doc_url')){
            $doc_url = ('storage/'.$post->doc_url);
            if(MemberQual::exists($doc_url)) {
                unlink($doc_url);
            }
            $file = file_upload($request->file('doc_url'),'service/documents');
           
            $post->doc_url = $file;
        }


        $post->update();
        return redirect()->back()->with('message', '10th qualification detail updated'); 
        //return back();

    }

    // update 12th from show
    public function twelve_qual_update_show()
    {
        $qualification = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','2')->first();

        return view('memberView.qualification.qualificationUpdate.twelve_qualification_update',compact('qualification'));
    }

    // update 12th from
    public function twelve_qual_update(Request $request,$id)
    {
        // return $request;
        $post = MemberQual::find($id);
        $post->location = $request->location;
        $post->board = $request->board;
        $post->pass_marks = $request->pass_marks;
        $post->pass_year = $request->pass_year;
        $post->pass_division = $request->pass_division;
        
        if($request->hasFile('doc_url')){
            $doc_url = ('storage/'.$post->doc_url);
            if(MemberQual::exists($doc_url)) {
                unlink($doc_url);
            }
            $file = file_upload($request->file('doc_url'),'service/documents');
           
            $post->doc_url = $file;
        }

        $post->update();
        return redirect()->back()->with('message', '12th qualification detail updated');

    }

   
    // update intern ship from show
    public function intern_qual_update_show()
    {
        $qualification = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','3')->first();

        return view('memberView.qualification.qualificationUpdate.intern_qualification_update',compact('qualification'));
    }

    // update internship form
    public function intern_qual_update(Request $request,$id)
    {
        // return $request;
        $post = MemberQual::find($id);
        $post->location = $request->location;
        $post->pass_marks = $request->pass_marks;
        $post->pass_year = $request->pass_year;
        $post->pass_division = $request->pass_division;
       

        if($request->hasFile('doc_url')){
            $doc_url = ('storage/'.$post->doc_url);
            if(MemberQual::exists($doc_url)) {
                unlink($doc_url);
            }
            $file = file_upload($request->file('doc_url'),'service/documents');
           
            $post->doc_url = $file;
        }
        $post->update();
        return redirect()->back()->with('message', 'internship qualification detail updated');

    }

    // update undergraduate from show
    public function undergraduate_qual_update_show()
    {
        $qualification = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','4')->first();

        return view('memberView.qualification.qualificationUpdate.UG_qualification_update',compact('qualification'));
    }

    // update undergraduate form
    public function undergraduate_qual_update(Request $request,$id)
    {
        // return $request;
        $post = MemberQual::find($id);
        $post->location = $request->location;
        $post->board = $request->board;
        $post->pass_marks = $request->pass_marks;
        $post->pass_year = $request->pass_year;
        $post->pass_division = $request->pass_division;
        
        if($request->hasFile('doc_url')){
            $doc_url = ('storage/'.$post->doc_url);
            if(MemberQual::exists($doc_url)) {
                unlink($doc_url);
            }
            $file = file_upload($request->file('doc_url'),'service/documents');
           
            $post->doc_url = $file;
        }

        $post->update();
        return redirect()->back()->with('message', 'qualification detail updated');

    }

    // update Master from show
    public function master_qual_update_show()
    {
        $qualification = MemberQual::where('user_id',Auth::user()->id)->where('qual_catg_code','5')->first();

        return view('memberView.qualification.qualificationUpdate.PG_qualification_update',compact('qualification'));
    }

    // update Master form
    public function master_qual_update(Request $request,$id)
    {
        // return $request;
        $post = MemberQual::find($id);
        $post->location = $request->location;
        $post->board = $request->board;
        $post->pass_marks = $request->pass_marks;
        $post->pass_year = $request->pass_year;
        $post->pass_division = $request->pass_division;
        
        if($request->hasFile('doc_url')){
            $doc_url = ('storage/'.$post->doc_url);
            if(MemberQual::exists($doc_url)) {
                unlink($doc_url);
            }
            $file = file_upload($request->file('doc_url'),'service/documents');
           
            $post->doc_url = $file;
        }

        $post->update();
        return redirect()->back()->with('message', 'qualification detail updated');

    }

}
