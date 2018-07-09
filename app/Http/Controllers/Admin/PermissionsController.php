<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PermissionsServices;

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
        $this->permissionsServices = new PermissionsServices();
        $this->middleware('auth.user');
    }

    public function index(Request $request)
    {
        $page = $request->input('page')??1;

        $permissionsResponses = $this->permissionsServices->getApiList($this->permissionsServices->getUrl(),self::PAGE_SIZE_DEFAULT,$page,[]);
        return view('permissions.list',
            [
                'permissions' => $permissionsResponses['data'],
                'boxTitle'=>'权限列表',
                'active' => 'permissions'
            ]
        );
    }

    public function edit($id){
        $permissionResponses = $this->permissionsServices->getApiInfo($this->permissionsServices->getRetrieveByIdUrl(),['id'=>$id]);
        return view('permissions.edit',
            [
                'permission' => $permissionResponses['data'],
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
                'active' => 'permissions'
            ]
        );
    }


}
