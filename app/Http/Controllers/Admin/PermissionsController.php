<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Permission;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->permissions = new Permission();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $permissions = $this->permissions->all();
        return view('permissions.list',
            [
                'permissions' => $permissions,
                'boxTitle'=>'权限列表',
                'active' => 'permissions'
            ]
        );
    }

    public function edit($id){
        $permission = $this->permissions::find($id);
        return view('permissions.edit',
            [
                'permission' => $permission,
                'route' => '/api/admin/permissions/edit/'.$id,
                'boxTitle'=>'修改权限',
                'active' => 'permissions'
            ]
        );
    }

    public function store(){
        return view('permissions.edit',
            [
                'route' => route('api.permissions.store'),
                'boxTitle'=>'添加权限',
                'active' => 'roles'
            ]
        );
    }


}
