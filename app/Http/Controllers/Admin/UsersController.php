<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\UsersModel;
use App\Eloquent\Role;
use App\Eloquent\RoleUserModel;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function index()
    {
        $companyId = \Auth()->user()->companyId;
        if(!empty($companyId)){
            $users = $this->users::where('companyId','=', $companyId)->get();
        }elseif(\Auth()->user()->id ===1){
            $users = $this->users::all();
        }else{
            $users = $this->users::where('id',"!=",'1')->get();
        }

        return view('users.list',
            [
                'users' => $users,
                'boxTitle'=>'用户列表',
                'active' => 'users'
            ]
        );
    }

    public function edit($id){
        /*控制管理员账号不能被修改*/
        if($id == 1 && \Auth()->user()->id != 1){
            $id = \Auth()->user()->id;
        }
        /*控制异常数据*/
        $companyId = \Auth()->user()->companyId;
        if(!empty($companyId)){
            $user = $this->users::where('companyId','=',$companyId)->find($id);
        }else{
            $user = $this->users::find($id);
        }
        $user = empty($user)?\Auth()->user():$user;

        $roles = Role::all();
        $roleUser = RoleUserModel::where('user_id','=',$user->id)->first();
        return view('users.edit',
            [
                'user' => $user,
                'route' => '/api/admin/users/edit/'.$id,
                'boxTitle'=> '编辑用户',
                'active' => 'users',
                'roles' => $roles,
                'roleUser'=> $roleUser
            ]
        );
    }

    public function store(){
        $roles = Role::all();
        return view('users.edit',
            [
                'route' => route('api.users.store'),
                'boxTitle'=>'添加用户',
                'active' => 'users',
                'roles' =>$roles
            ]
        );
    }


}
