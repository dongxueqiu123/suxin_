<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\Role;
use App\Eloquent\PermissionRoleModel;
use Illuminate\Http\Request;
//se Spatie\Permission\Models\Permission;
use App\Eloquent\Permission;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->roles = new Role();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $request->validate([
            'description' => 'required',
            'name' => 'required',
        ]);
        $role = Role::find($id);
        $input = $request->only(['name', 'description', 'permissionIdsStr']);
        $permissionIds = explode(',',$input['permissionIdsStr']);
        $role->description = $input['description'];
        $role->name = $input['name'];
        if($state = $role->save()){
            PermissionRoleModel::where('role_id','=',$role->id)->delete();
            foreach($permissionIds as $permissionId){
                $permission = Permission::find($permissionId);
                $role->attachPermission($permission);
            }
            return response()->json([
                'state' => $state,
                'route' => route('roles')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'description' => 'required',
            'name' => 'required',
        ]);
        $input = $request->only(['name', 'description', 'permissionIdsStr']);
        $permissionIds = explode(',',$input['permissionIdsStr']);
        $role = new Role();
        $role->name = $input['name'];
        $role->description = $input['description'];
        if($state = $role->save()){
            foreach($permissionIds as $permissionId){
                $permission = Permission::find($permissionId);
                $role->attachPermission($permission);
            }
            return response()->json([
                'state' => $state,
                'route' => route('roles')
            ]);
        }
    }

    public function delete($id){
        if($state = Role::where('id',$id)->delete()){
            return response()->json([
                'state' => $state,
                'route' => route('roles')
            ]);
        }
    }



}
