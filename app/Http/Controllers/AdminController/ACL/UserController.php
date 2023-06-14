<?php

namespace Modules\Admin\Http\Controllers\ACL;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Permission;
use App\Mail\UserMail;
use Mail;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin::acl.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin::acl.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string','max:11','min:10', 'unique:users'],
        ]); 

        $password  = str_limit($data['name'],3,'@123');
        $data['password'] = Hash::Make($password);        
        $user = User::create($data);
        //$user->attachRole($request->role);
        $user->remember_token = Str::random(40);
        $user->save();

        $user['password'] = $password;

        // if($request->role == '3'){
        //    member_create($user);
        // }
        
        Mail::to($user->email)->send(new UserMail($user));
        return redirect('/acl/user')->with('success','User Created Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::acl.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin::acl.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'phone' => ['required','string','max:11','min:10', 'unique:users,phone,'.$id],
        ]); 

        $user = User::find($id);
        $email = $user->email;
        $phone = $user->phone;
        $user->update($data);
        if($phone != $user->phone || $email != $user->email){
            $password  = str_limit($data['name'],3,'@123');
            $user->password = Hash::Make($password);
            if($phone != $user->phone){
                $user->phone_verified_at = null;
                $user->code = null;
                $user->save();
            }
            if($email != $user->email){
                $user->email_verified_at = null;
                $user->remember_token = Str::random(40);
                $user->save();
                $user['password'] = $password;
                Mail::to($user->email)->send(new UserMail($user));   
            }            
        }

        return redirect('/acl/user')->with('success','User Updated Successfully');
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

    public function role($id){
        $user = User::with('roles')->where('id',$id)->first();
        $roles = Role::all();
        return view('admin::acl.users.role',compact('user','roles'));
    }

    public function role_assign(Request $request){
       $user = User::find($request->user_id);
       $user->syncRoles($request->roles); 
       return redirect()->back()->with('success','Roles Updated Successfully');
    }
    public function permission($id){
        $user = $user = User::with('permissions')->where('id',$id)->first();
        $permissions = Permission::all();
        return view('admin::acl.users.permission',compact('user','permissions'));
    }

    public function permission_assign(Request $request){
       $user = User::find($request->user_id);
       $user->syncPermissions($request->permissions);
       return redirect()->back()->with('success','Permissions Updated Successfully');
    }


}
