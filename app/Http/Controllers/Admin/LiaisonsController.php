<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午4:41
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LiaisonsServices;
use App\Services\EquipmentsServices;
use App\Services\CollectorsServices;
use App\Services\CompaniesServices;
use App\Services\ThresholdsServices;

class LiaisonsController extends Controller {

    public function __construct()
    {
        $this->liaisonsServices   = new LiaisonsServices();
        $this->thresholdsServices = new ThresholdsServices();
        $this->equipmentsServices = new EquipmentsServices();
        $this->collectorsServices = new CollectorsServices();
        $this->companiesServices = new CompaniesServices();
    }

    public function index()
    {
        $queryArray['firmId'] = \Auth()->user()->company->id??'';
        $liaisons = $this->liaisonsServices->getList(static::PAGE_SIZE_DEFAULT,$queryArray);
        return view('liaisons.list',
            [
                'liaisons' => $liaisons,
                'boxTitle'=>'告警联系人列表',
                'active' => 'liaisons'
            ]
        );
    }

    public function edit($id){
        $liaison = $this->liaisonsServices->get($id);
        //$patterns = $this->thresholdsServices->getConstant(null,'pattern');
        $companies = $this->companiesServices->getAll();
        return view('liaisons.edit',
            [
                'route' => '/api/admin/liaisons/edit/'.$id,
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'getCollectorUrl' => route('api.collectors.getCollectors'),
                'boxTitle'=> '修改告警联系人',
                'active' => 'liaisons',
                'liaison' => $liaison,
                'companies' => $companies,
            ]
        );
    }

    public function store(){
        //$patterns = $this->thresholdsServices->getConstant(null,'pattern');
        $companies = $this->companiesServices->getAll();
        return view('liaisons.edit',
            [
                'route' => route('api.liaisons.store'),
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'getCollectorUrl' => route('api.collectors.getCollectors'),
                'boxTitle'=>'添加告警联系人',
                'active' => 'liaisons',
                'companies' => $companies,
            ]
        );
    }
}