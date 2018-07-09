<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UsersServices;
use App\Services\RolesServices;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->usersServices = new UsersServices();
        $this->rolesServices = new RolesServices();
    }

    public function index(Request $request)
    {
        $page = $request->input('page')??1;
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;

        $responses = $this->usersServices->getApiList($this->usersServices->getUrl(),self::PAGE_SIZE_DEFAULT,$page,$queryArray);

        return view('users.list',
            [
                'users' => $responses['data'],
                'boxTitle'=>'用户列表',
                'active' => 'users'
            ]
        );
    }

    public function edit($id){
        $userResponses = $this->usersServices->getApiInfo($this->usersServices->getRetrieveByIdUrl(),['id'=>$id]);
        $rolesResponses = $this->rolesServices->getApiInfo($this->rolesServices->getUrl(),[]);

        return view('users.edit',
            [
                'user' => $userResponses['data'],
                'route' => '/api/admin/users/edit/'.$id,
                'boxTitle'=> '编辑用户',
                'active' => 'users',
                'roles' => $rolesResponses['data'],
            ]
        );
    }

    public function store(){
        $rolesResponses = $this->rolesServices->getApiInfo($this->rolesServices->getUrl(),[]);
        return view('users.edit',
            [
                'route' => route('api.users.store'),
                'boxTitle' => '添加用户',
                'active' => 'users',
                'roles' => $rolesResponses['data'],
            ]
        );
    }


}
