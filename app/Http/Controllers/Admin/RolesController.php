<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Role;
use App\Eloquent\Permission;
use App\Eloquent\PermissionRoleModel;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roles = new Role();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $roles = $this->roles->all();
        return view('roles.list',
            [
                'roles' => $roles,
                'boxTitle'=>'角色列表',
                'active' => 'roles'
            ]
        );
    }

    public function edit($id){
        $role = $this->roles::find($id);

        $permissions = Permission::all();
        $permissionRoles = PermissionRoleModel::where('role_id','=',$role->id)->get();
        return view('roles.edit',
            [
                'role' => $role,
                'route' => '/api/admin/roles/edit/'.$id,
                'boxTitle'=>'编辑角色',
                'active' => 'roles',
                'permissions'=> $permissions,
                'permissionRoles'=>$permissionRoles
            ]
        );
    }

    public function store(){
        $permissions = Permission::all();
        return view('roles.edit',
            [
                'route' => route('api.roles.store'),
                'boxTitle'=>'添加角色',
                'active' => 'roles',
                'permissions'=> $permissions,
            ]
        );
    }


}
