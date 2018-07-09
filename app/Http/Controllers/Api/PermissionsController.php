<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\Permission;
use Illuminate\Http\Request;
use App\Services\PermissionsServices;

class PermissionsController extends Controller
{

    public function __construct()
    {
        //$this->companies = new CompaniesModel();
        $this->permissionsServices = new PermissionsServices();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){

        $input = $request->only(['name', 'description','displayName']);
        $input['id'] = $id;
        if($state = $this->permissionsServices->postClient($this->permissionsServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('permissions'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function store(Request $request){

        $input = $request->only(['name', 'description', 'displayName']);

        if($state = $this->permissionsServices->postClient($this->permissionsServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('permissions'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function delete($id){

        if($state = $this->permissionsServices->postClient($this->permissionsServices->getDeleteUrl(),['id'=>$id])){
            return response()->json([
                'state' => $state['code'],
                'route' => route('permissions'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }



}
