<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\UsersModel;
use App\Eloquent\RoleUserModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        //$this->companies = new CompaniesModel();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password'=>'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'roleId' => 'required',
        ]);
        $user = UsersModel::find($id);
        $input = $request->only(['name', 'email', 'password', 'roleId']);
        $result = $this->isIssetEmail($input['email'],$id);
        if($result){
            return response()->json(['state' => '201', 'info' => '邮箱已存在']);
        }
        (bcrypt($input['password']) != $user->password)
        && $user->password = bcrypt($input['password']);
        $user->email = $input['email'];
        $user->name = $input['name'];
        if($state = $user->save()){
            RoleUserModel::where('user_id','=',$user->id)->delete();
            $user->attachRole($input['roleId']);
            return response()->json([
                'state' => $state,
                'route' => route('users')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password'=>'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'roleId' => 'required',
        ]);
        $input = $request->only(['name', 'email', 'password', 'roleId']);
        $result = $this->isIssetEmail($input['email']);
        if($result){
            return response()->json(['state' => '201', 'info' => '邮箱已存在']);
        }
        $user = UsersModel::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'companyId' => \Auth()->user()->companyId
        ]);
        if($user){
            $user->attachRole($input['roleId']);
            return response()->json([
                'state' => 200,
                'route' => route('users')
            ]);
        }
    }

    public function delete($id){
        if($state = UsersModel::destroy($id)){
            return response()->json([
                'state' => $state,
                'route' => route('users')
            ]);
        }
    }

    public function email(){

    }

    public function isIssetEmail($email,$userId = ''){
        $usersModel = new UsersModel();
        $user = $usersModel->email($email)->first();

        $result = false;
        if(!empty($user)){
            if($userId){
                $otherUser = UsersModel::find($userId);
                ($user->id !== $otherUser->id) && $result = true;
            }else{
                $result = true;
            }
        }
        return $result;
    }
}
