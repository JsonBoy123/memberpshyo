<?php

namespace Modules\Admin\Http\Controllers\ACL;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Role;
use App\Permission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = Role::all();
        // foreach ($roles as $key => $value) {
        //     echo "<pre>";
        //     print_r(count($value->permissions) !=0 ? $value->permissions : '');
        //     echo "</pre>";
        // }
        // die;
        return view('admin::acl.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin::acl.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->validate([
            'name'          => 'required|string|min:4|max:100|unique:roles',
            'display_name'  => 'required|string|min:4|max:100|unique:roles',
            'description'   => 'required|string|min:6|max:150'
        ]);

        $role = Role::create($data);

        if(count($request->all()) !=4){
            if($request->permissions !=null){
                $role->syncPermissions($request->permissions);
            }     
        }
        
        return redirect('/acl/role/')->with('success','Role Created Successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('admin::acl.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'          => 'required|string|min:4|max:100|unique:roles,name,'.$id,
            'display_name'  => 'required|string|min:4|max:100|unique:roles,display_name,'.$id,
            'description'   => 'required|string|min:6|max:150'
        ]);
        $role = Role::find($id);
        $role->update($data);

        if($request->permissions !=null){
            $role->syncPermissions($request->permissions);
        }

        return redirect('/acl/role/')->with('success','Role Updated Successfully');
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
}
