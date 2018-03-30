<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\UsersModel;
use App\Eloquent\Role;
use App\Eloquent\RoleUserModel;
use App\Eloquent\EquipmentsModel;
use App\Eloquent\CompaniesModel;
use App\Http\Controllers\Controller;

class EquipmentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->equipments = new EquipmentsModel();
        $this->companies  = new CompaniesModel();
        $this->middleware('auth.user');
    }

    public function index()
    {
//        $companyId = \Auth()->user()->companyId;
//        if(!empty($companyId)){
//            $users = $this->users::where('companyId','=', $companyId)->get();
//        }elseif(\Auth()->user()->id ===1){
//            $users = $this->users::all();
//        }else{
//            $users = $this->users::where('id',"!=",'1')->get();
//        }

        $equipments = $this->equipments::all();
        return view('equipments.list',
            [
                'equipments' => $equipments,
                'boxTitle'=>'机械设备列表',
                'active' => 'equipments'
            ]
        );
    }

    public function edit($id){
        /*控制管理员账号不能被修改*/
/*        if($id == 1 && \Auth()->user()->id != 1){
            $id = \Auth()->user()->id;
        }*/
        /*控制异常数据*/
/*        $companyId = \Auth()->user()->companyId;
        if(!empty($companyId)){
            $user = $this->users::where('companyId','=',$companyId)->find($id);
        }else{
            $user = $this->users::find($id);
        }
        $user = empty($user)?\Auth()->user():$user;

        $roles = Role::all();
        $roleUser = RoleUserModel::where('user_id','=',$user->id)->first();*/
        $equipment = $this->equipments::where('id','=',$id)->first();
        $companies = $this->companies::get();
        return view('equipments.edit',
            [
                'equipment' => $equipment,
                'route' => '/api/admin/equipments/edit/'.$id,
                'boxTitle'=> '修改机械设备',
                'active' => 'equipments',
                'companies' => $companies
            ]
        );
    }

    public function store(){
        $companies = $this->companies::all();
        return view('equipments.edit',
            [
                'route' => route('api.equipments.store'),
                'boxTitle'=>'添加机械设备',
                'active' => 'equipments',
                'companies' =>$companies
            ]
        );
    }


}
