<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Role;
use App\Eloquent\Permission;
use Illuminate\Http\Request;
use App\Eloquent\PermissionRoleModel;
use App\Http\Controllers\Controller;
use App\Services\RolesServices;
use App\Services\PermissionsServices;

class RolesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->rolesServices = new RolesServices();
        $this->permissionsServices = new PermissionsServices();
        $this->roles = new Role();
        $this->middleware('auth.user');
    }

    public function index(Request $request)
    {
        $page = $request->input('page')??1;
        $rolesResponses = $this->rolesServices->getApiList($this->rolesServices->getUrl(),self::PAGE_SIZE_DEFAULT,$page,[]);
        return view('roles.list',
            [
                'roles' => $rolesResponses['data'],
                'boxTitle'=>'角色列表',
                'active' => 'roles'
            ]
        );
    }

    public function edit($id){
        $roleResponses = $this->rolesServices->getApiInfo($this->rolesServices->getRetrieveByIdUrl(),['id'=>$id]);
        $permissionsResponses = $this->permissionsServices->getApiInfo($this->permissionsServices->getAllPermissionsUrl(),[]);
        $roleResponses['data']['permissionIdsStr'] = json_decode($roleResponses['data']['permissionIdsStr']);
        return view('roles.edit',
            [
                'role' => $roleResponses['data'],
                'route' => '/api/admin/roles/edit/'.$id,
                'boxTitle'=>'编辑角色',
                'active' => 'roles',
                'permissions'=> $permissionsResponses['data'],
            ]
        );
    }

    public function store(){
        $permissionsResponses = $this->permissionsServices->getApiInfo($this->permissionsServices->getUrl(),[]);
        return view('roles.edit',
            [
                'route' => route('api.roles.store'),
                'boxTitle'=>'添加角色',
                'active' => 'roles',
                'permissions'=> $permissionsResponses['data'],
            ]
        );
    }


}
