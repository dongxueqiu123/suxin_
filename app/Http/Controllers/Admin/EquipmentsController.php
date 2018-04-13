<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\EquipmentsModel;
use App\Eloquent\CompaniesModel;
use App\Services\EquipmentsServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EquipmentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->equipmentsServices = new EquipmentsServices();
        $this->equipments = new EquipmentsModel();
        $this->companies  = new CompaniesModel();
    }

    public function index()
    {
        $queryArray['firmId'] = \Auth()->user()->company->id??'';
        $equipments = $this->equipmentsServices->getList(static::PAGE_SIZE_DEFAULT, $queryArray);
/*        if(!\Auth()->user()->company){
            $equipments = $this->equipmentsServices->getAll();
            $providerEquipments = $equipments;
            $consumerEquipments = $equipments;
        }else{
            $id =\Auth()->user()->company->id;
            $providerQueryArray['providerId'] = $id;
            $providerEquipments = $this->equipmentsServices->getList(0,$providerQueryArray);
            $consumerQueryArray['consumerId'] = $id;
            $consumerEquipments = $this->equipmentsServices->getList(0,$consumerQueryArray);
            $equipments = $providerEquipments->merge($consumerEquipments)->unique();
        }*/
        return view('equipments.list',
            [
                'boxTitle'=>'机械设备列表',
                'active' => 'equipments',
                'equipments'=>$equipments
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
