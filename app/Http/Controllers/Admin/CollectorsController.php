<?php

namespace App\Http\Controllers\Admin;

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

    public function index()
    {
        $queryArray['firmId'] = \Auth()->user()->company->id??'';
        $collectors = $this->collectorsServices->getList(static::PAGE_SIZE_DEFAULT, $queryArray);
        return view('collectors.list',
            [
                'collectors' => $collectors,
                'boxTitle'=>'采集设备列表',
                'active' => 'collectors'
            ]
        );
    }

    public function edit($id){
        $collector = $this->collectorsServices->get($id);
        $companies = $this->companiesServices->getAll();
        $patternStatus = $this->thresholdsServices->getPatternStatus($collector);
        return view('collectors.edit',
            [
                'collector' => $collector,
                'route' => '/api/admin/collectors/edit/'.$id,
                'boxTitle'=> '修改采集设备',
                'active' => 'collectors',
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'patternStatus' => $patternStatus,
                'companies' => $companies
            ]
        );
    }

    public function store(){
        $equipments = $this->equipmentsServices->getList();
        $companies = $this->companiesServices->getAll();
        $patterns = $this->thresholdsServices->getPattern(['collector_id']);
        return view('collectors.edit',
            [
                'equipments' => $equipments,
                'route' => route('api.collectors.store'),
                'boxTitle'=>'添加采集设备',
                'active' => 'collectors',
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'patterns' => $patterns,
                'companies' => $companies
            ]
        );
    }


}
