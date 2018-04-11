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
        $this->middleware('auth.user');
    }

    public function index()
    {
        $user = \Auth()->user();
        $collectors = $this->collectorsServices->getList(0, []);
        $filterCollectors = $this->collectorsServices->getCompanyAndEquipmentCollectors($collectors, $user);
        $collectors = array_merge($filterCollectors['company']??[],$filterCollectors['equipment']??[]);
        return view('collectors.list',
            [
                'companyCollectors' => $filterCollectors['company']??[],
                'equipmentCollectors' => $filterCollectors['equipment']??[],
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
