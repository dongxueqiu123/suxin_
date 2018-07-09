<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\Role;
use Illuminate\Http\Request;
use App\Eloquent\Permission;
use App\Services\RolesServices;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->roles = new Role();
        $this->rolesServices = new RolesServices();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){

        $input = $request->only(['name', 'description', 'permissionIdsStr']);
        $input['id'] = $id;
        if($state = $this->rolesServices->postClient($this->rolesServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('roles'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function store(Request $request){
        $input = $request->only(['name', 'description', 'permissionIdsStr']);
        if($state = $this->rolesServices->postClient($this->rolesServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('roles'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function delete($id){

        if($state = $this->rolesServices->postClient($this->rolesServices->getDeleteUrl(),['id'=>$id])){
            return response()->json([
                'state' => $state['code'],
                'route' => route('roles'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }



}
