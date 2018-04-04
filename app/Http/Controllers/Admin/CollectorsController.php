<?php

namespace App\Http\Controllers\Admin;

use App\Services\CollectorsServices;
use App\Services\EquipmentsServices;
use App\Services\CompaniesServices;
use App\Eloquent\EquipmentsModel;
use App\Eloquent\CollectorsModel;
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
        $this->collectors = new CollectorsModel();
        $this->equipments = new EquipmentsModel();
        $this->collectorsServices = new CollectorsServices();
        $this->equipmentsServices = new EquipmentsServices();
        $this->companiesServices = new CompaniesServices();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $company = \Auth()->user()->company;
        $queryArray['pattern'] = '1';
        $companyCollectors = $this->collectorsServices->getList(0, $queryArray);
        $queryArray['pattern'] = '2';
        $collectors = $this->collectorsServices->getList(0, $queryArray);

        if($company){
            $companyCollectors = $this->companiesServices->getModelsByCompany($companyCollectors);
            $collectors = $this->equipmentsServices->getModelsByEquipment($collectors);
        }


//
//        $company = \Auth()->user()->company;
//        $queryArray['pattern'] = '2';
//        $equipmentCollectors = $this->collectorsServices->getList(0, $queryArray);
//        if(!$company) {
//            $queryArray['pattern'] = '1';
//
//        }else{
//            $queryArray['pattern'] = '1';
//            $queryArray['patternId'] = $company->id;
//            $providerQueryArray['providerId'] = $company->id;
//            $consumerQueryArray['consumerId'] = $company->id;
//        }
//        $companyCollectors = $this->collectorsServices->getList(0, $queryArray);
//
//        $providerEquipments = $this->equipmentsServices->getList(0,$providerQueryArray??[]);
//
//        $collectors = collect();
//        foreach ($providerEquipments as $key=>$providerEquipment){
//            foreach ($equipmentCollectors as $equipmentCollector){
//                if($providerEquipment->id == $equipmentCollector->pattern_id){
//                    $collector = clone $equipmentCollector;
//                    $collector->status = 'provider';
//                    $collector->equipmentName = $providerEquipment->name;
//                    $collector->companyName = $providerEquipment->provider->name;
//                    $collectors->push($collector);
//                }
//            }
//        }
//
//        $consumerEquipments = $this->equipmentsServices->getList(0,$consumerQueryArray??[]);
//        foreach ($consumerEquipments as $key=>$consumerEquipment){
//            foreach ($equipmentCollectors as $equipmentCollector){
//                if($consumerEquipment->id == $equipmentCollector->pattern_id){
//                    $equipmentCollector->status = 'consumer';
//                    $equipmentCollector->equipmentName = $consumerEquipment->name;
//                    $equipmentCollector->companyName = $consumerEquipment->consumer->name;
//                    $collectors->push($equipmentCollector);
//                }
//            }
//        }
//
        return view('collectors.list',
            [
                'companyCollectors' => $companyCollectors,
                'equipmentCollectors' => $collectors,
                'boxTitle'=>'采集设备列表',
                'active' => 'collectors'
            ]
        );
    }

    public function edit($id){
        $collector = $this->collectors::where('id','=',$id)->first();
        $equipments = $this->equipments::get();
        return view('collectors.edit',
            [
                'collector' => $collector,
                'route' => '/api/admin/collectors/edit/'.$id,
                'boxTitle'=> '修改采集设备',
                'active' => 'collectors',
                'equipments' => $equipments
            ]
        );
    }

    public function store(){
        $equipments = $this->equipments::get();
        return view('collectors.edit',
            [
                'equipments' => $equipments,
                'route' => route('api.collectors.store'),
                'boxTitle'=>'添加采集设备',
                'active' => 'collectors',
            ]
        );
    }


}
