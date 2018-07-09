<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Eloquent\EquipmentsModel;
use App\Eloquent\CompaniesModel;
use App\Services\EquipmentsServices;
use App\Services\CompaniesServices;
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
        $this->equipmentsServices = new EquipmentsServices();
        $this->companiesServices = new CompaniesServices();
        $this->equipments = new EquipmentsModel();
        $this->companies  = new CompaniesModel();
    }

    public function index(Request $request)
    {
        $page = $request->input('page')??1;

        $queryArray['firmId'] = (\Auth()->user()->companyId??1) == 0?1:(\Auth()->user()->companyId??1);

        //$equipments = $this->equipmentsServices->getList(static::PAGE_SIZE_DEFAULT, $queryArray);
        $responses = $this->equipmentsServices->getApiList($this->equipmentsServices->getUrl(),static::PAGE_SIZE_DEFAULT,$page,$queryArray);

        return view('equipments.list',
            [
                'boxTitle'=>'机械设备列表',
                'active' => 'equipments',
                'equipments'=>$responses['data']
            ]
        );
    }

    public function edit($id){
        $equipmentResponses = $this->equipmentsServices->getApiInfo($this->equipmentsServices->getEquipmentByIdUrl(), ['id'=>$id]);
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getUrl() ,[]);
        return view('equipments.edit',
            [
                'equipment' => $equipmentResponses['data'],
                'route' => '/api/admin/equipments/edit/'.$id,
                'boxTitle'=> '修改机械设备',
                'active' => 'equipments',
                'companies' => $companyResponses['data']
            ]
        );
    }

    public function store(){
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getUrl() ,[]);
        return view('equipments.edit',
            [
                'route' => route('api.equipments.store'),
                'boxTitle'=>'添加机械设备',
                'active' => 'equipments',
                'companies' =>$companyResponses['data']
            ]
        );
    }


}
