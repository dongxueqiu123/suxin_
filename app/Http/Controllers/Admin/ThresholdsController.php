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
        $user = \Auth()->user();
        $thresholds = $this->thresholdsServices->getList();
        $filterThresholds = $this->thresholdsServices->getFilterThresholds($thresholds, $user);
        $thresholds = array_merge($filterThresholds['company'], $filterThresholds['equipment'], $filterThresholds['collector']);
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        return view('thresholds.list',
            [
                'thresholds'   => $thresholds??[],
                'boxTitle'=>'告警阈值列表',
                'active' => 'thresholds',
                'categories' => $categories,
                'grades' => $grades,
            ]
        );
    }

    public function edit($id){
        $threshold= $this->thresholdsServices->get($id);
        $patterns   = $this->thresholdsServices->getPattern();
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        $patternStatus = $this->thresholdsServices->getPatternStatus($threshold);
        $companies = $this->companiesServices->getAll();
        return view('thresholds.edit',
            [
                'route' => '/api/admin/thresholds/edit/'.$id,
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'getCollectorUrl' => route('api.collectors.getCollectors'),
                'boxTitle'=> '修改告警阈值',
                'active' => 'thresholds',
                'threshold' => $threshold,
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
                'patternStatus' => $patternStatus,
                'companies' => $companies,
            ]
        );
    }

    public function store(){
        $patterns   = $this->thresholdsServices->getPattern();
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        $companies = $this->companiesServices->getAll();

        return view('thresholds.edit',
            [
                'route' => route('api.thresholds.store'),
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'getCollectorUrl' => route('api.collectors.getCollectors'),
                'boxTitle'=>'添加告警阈值',
                'active' => 'thresholds',
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
                'companies' => $companies,
            ]
        );
    }


}
