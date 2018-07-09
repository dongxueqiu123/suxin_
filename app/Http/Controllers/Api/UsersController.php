<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\UsersModel;
use App\Eloquent\RoleUserModel;
use Illuminate\Http\Request;
use App\Services\UsersServices;
use App\Services\RolesServices;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->usersServices = new UsersServices();
        $this->rolesServices = new RolesServices();

        //$this->middleware('auth.user');
    }

    public function edit($id,Request $request){

        $input = $request->only(['name', 'email', 'password', 'roleId', 'confirmPassword']);
        $input['companyId'] = (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        $input['id'] = $id;

        if($state = $this->usersServices->postClient($this->usersServices->getSaveUrl(),$input)){

            return response()->json([
                'state' => $state['code'],
                'route' => route('users'),
                'info'  => config('code.users.'.$state['code'])??config('code.'.$state['code'])
            ]);
        }
    }

    public function store(Request $request){
        $input = $request->only(['name', 'email', 'password', 'roleId', 'confirmPassword']);
        $input['companyId'] = (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        if($state = $this->usersServices->postClient($this->usersServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('users'),
                'info'  => config('code.users.'.$state['code'])??config('code.'.$state['code'])
            ]);
        }
    }

    public function delete($id){
        if($state = $this->usersServices->postClient($this->usersServices->getDeleteUrl(),['id'=>$id])){
            return response()->json([
                'state' => $state['code'],
                'route' => route('users'),
                'info'  => config('code.users.'.$state['code'])??config('code.'.$state['code'])
            ]);
        }
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
