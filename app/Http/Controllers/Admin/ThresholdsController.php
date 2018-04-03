<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 2018/3/30
 * Time: 10:07
 */
namespace App\Http\Controllers\Admin;

use App\Services\ThresholdsServices;
use App\Services\EquipmentsServices;
use App\Services\CollectorsServices;
use App\Services\CompaniesServices;
use App\Http\Controllers\Controller;

class ThresholdsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $companyThresholds = $this->thresholdsServices->getList(0,$companyQueryArray);
        $equipmentThresholds = $this->thresholdsServices->getList(0,$equipmentQueryArray);
        $collectorThresholds = $this->thresholdsServices->getList(0,$collectorQueryArray);
        if($company = \Auth()->user()->company){

            $companyThresholds = $this->companiesServices->getModelsByCompany($companyThresholds);

            $equipmentThresholds = $this->equipmentsServices->getModelsByEquipment($equipmentThresholds);

            $collectorThresholds = $this->collectorsServices->getModelsByCollector($collectorThresholds);

        }
        $companyThresholds = $this->thresholdsServices->getChName($companyThresholds);
        $equipmentThresholds = $this->thresholdsServices->getChName($equipmentThresholds);
        $collectorThresholds = $this->thresholdsServices->getChName($collectorThresholds);
        return view('thresholds.list',
            [
                'companyThresholds' => $companyThresholds,
                'equipmentThresholds' => $equipmentThresholds,
                'collectorThresholds' => $collectorThresholds,
                'boxTitle'=>'告警阈值列表',
                'active' => 'thresholds'
            ]
        );
    }

    public function edit($id){
        $threshold= $this->thresholdsServices->get($id);
        $patterns   = $this->thresholdsServices->getConstant(null,'pattern');
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        return view('thresholds.edit',
            [
                'route' => '/api/admin/thresholds/edit/'.$id,
                'boxTitle'=> '修改告警阈值',
                'active' => 'thresholds',
                'threshold' => $threshold,
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
            ]
        );
    }

    public function store(){
        $patterns   = $this->thresholdsServices->getConstant(null,'pattern');
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        return view('thresholds.edit',
            [
                'route' => route('api.thresholds.store'),
                'boxTitle'=>'添加告警阈值',
                'active' => 'thresholds',
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
            ]
        );
    }


}
