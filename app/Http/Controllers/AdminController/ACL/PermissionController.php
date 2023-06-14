<?php

namespace Modules\Admin\Http\Controllers\ACL;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Permission;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin::acl.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::acl.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|min:4|max:100|unique:permissions',
            'display_name'  => 'required|string|min:4|max:100|unique:permissions',
            'description'   => 'required|string|min:6|max:150'
        ]);

        $permission = Permission::create($data);
        return redirect('/acl/permission/')->with('success','Permission Created Successfully');
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
        $permission = Permission::find($id);        
        return view('admin::acl.permissions.edit',compact('permission'));
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
            'name'          => 'required|string|min:4|max:100|unique:permissions,name,'.$id,
            'display_name'  => 'required|string|min:4|max:100|unique:permissions,display_name,'.$id,
            'description'   => 'required|string|min:6|max:150'
        ]);

        Permission::find($id)->update($data);
        return redirect('/acl/permission/')->with('success','Permission Updated Successfully');
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
