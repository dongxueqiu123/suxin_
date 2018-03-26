<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    public function __construct()
    {
        //$this->companies = new CompaniesModel();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $request->validate([
            'description' => 'required',
            'name' => 'required',
            'display_name' => 'required'
        ]);
        $permission = Permission::find($id);
        $input = $request->only(['name', 'description','display_name']);
        $permission->description = $input['description'];
        $permission->name = $input['name'];
        $permission->display_name = $input['display_name'];
        if($state = $permission->save()){
            return response()->json([
                'state' => $state,
                'route' => route('permissions')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'description' => 'required',
            'name' => 'required',
            'display_name' => 'required'
        ]);
        $input = $request->only(['name', 'description', 'display_name']);
        $state = Permission::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'display_name' => $input['display_name']
        ]);
        if($state){
            return response()->json([
                'state' => $state,
                'route' => route('permissions')
            ]);
        }
    }

    public function delete($id){
        if($state = Permission::where('id',$id)->delete()){
            return response()->json([
                'state' => $state,
                'route' => route('permissions')
            ]);
        }
    }



}
