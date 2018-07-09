<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CollectorsServices;
use App\Services\EquipmentsServices;
use App\Services\CompaniesServices;
use App\Services\ThresholdsServices;
use App\Http\Controllers\Controller;

class CollectorsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->collectorsServices = new CollectorsServices();
        $this->equipmentsServices = new EquipmentsServices();
        $this->companiesServices = new CompaniesServices();
        $this->thresholdsServices = new ThresholdsServices();
    }

    public function index(Request $request)
    {
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        $page = $request->input('page')??1;
        $ext['sort'] = true;
        $responses = $this->collectorsServices->getApiList($this->collectorsServices->getUrl(),static::PAGE_SIZE_DEFAULT, $page,$queryArray);
        return view('collectors.list',
            [
                'collectors' => $responses['data'],
                'boxTitle'=>'采集设备列表',
                'active' => 'collectors'
            ]
        );
    }

    public function edit($id){
        $queryArray['id'] = $id;
       // $collector = $this->collectorsServices->get($id);
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getUrl() ,[]);
        $responses = $this->collectorsServices->getInfoClient($this->collectorsServices->getCollectorByIdUrl() ,$queryArray);
        $collector = $responses['data'];
        $patternStatus = $this->thresholdsServices->getPatternStatus($collector);
        return view('collectors.edit',
            [
                'collector' => $collector,
                'route' => '/api/admin/collectors/edit/'.$id,
                'boxTitle'=> '修改采集设备',
                'active' => 'collectors',
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'patternStatus' => $patternStatus,
                'companies' => $companyResponses['data']
            ]
        );
    }

    public function store(){
        $equipmentResponses = $this->equipmentsServices->getInfoClient($this->equipmentsServices->getUrl() ,[]);
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getUrl() ,[]);

        $patterns = $this->thresholdsServices->getPattern(['collector_id']);
        return view('collectors.edit',
            [
                'equipments' => $equipmentResponses['data'],
                'route' => route('api.collectors.store'),
                'boxTitle'=>'添加采集设备',
                'active' => 'collectors',
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'patterns' => $patterns,
                'companies' => $companyResponses['data']
            ]
        );
    }


}
