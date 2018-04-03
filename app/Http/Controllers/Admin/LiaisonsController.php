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
        $this->middleware('auth.user');
    }

    public function index()
    {
        $companyQueryArray['pattern'] = '1';
        $equipmentQueryArray['pattern'] = '2';
        $collectorQueryArray['pattern'] = '3';
        $companyLiaisons = $this->liaisonsServices->getList(0,$companyQueryArray);
        $equipmentLiaisons = $this->liaisonsServices->getList(0,$equipmentQueryArray);
        $collectorLiaisons = $this->liaisonsServices->getList(0,$collectorQueryArray);
        if($company = \Auth()->user()->company){
            $companyLiaisons = $this->companiesServices->getModelsByCompany($companyLiaisons);
            $equipmentLiaisons = $this->equipmentsServices->getModelsByEquipment($equipmentLiaisons);
            $collectorLiaisons = $this->collectorsServices->getModelsByCollector($collectorLiaisons);
        }

        $companyLiaisons = $this->thresholdsServices->getChName($companyLiaisons);
        $equipmentLiaisons = $this->thresholdsServices->getChName($equipmentLiaisons);
        $collectorLiaisons = $this->thresholdsServices->getChName($collectorLiaisons);

        return view('liaisons.list',
            [
                'companyLiaisons' => $companyLiaisons,
                'equipmentLiaisons' => $equipmentLiaisons,
                'collectorLiaisons' => $collectorLiaisons,
                'boxTitle'=>'告警联系人列表',
                'active' => 'liaisons'
            ]
        );
    }

    public function edit($id){
        $liaison = $this->liaisonsServices->get($id);
        $patterns = $this->thresholdsServices->getConstant(null,'pattern');
        return view('liaisons.edit',
            [
                'route' => '/api/admin/liaisons/edit/'.$id,
                'boxTitle'=> '修改告警联系人',
                'active' => 'liaisons',
                'liaison' => $liaison,
                'patterns' => $patterns,
            ]
        );
    }

    public function store(){
        $patterns = $this->thresholdsServices->getConstant(null,'pattern');
        return view('liaisons.edit',
            [
                'route' => route('api.liaisons.store'),
                'boxTitle'=>'添加告警联系人',
                'active' => 'liaisons',
                'patterns' => $patterns,
            ]
        );
    }
}