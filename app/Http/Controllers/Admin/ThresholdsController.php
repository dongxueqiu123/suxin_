<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 2018/3/30
 * Time: 10:07
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
    }

    public function index(Request $request)
    {
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        $page = $request->input('page')??1;
        //$thresholds = $this->thresholdsServices->getList(static::PAGE_SIZE_DEFAULT,$queryArray);
        $responses = $this->thresholdsServices->getApiList($this->thresholdsServices->getUrl(),static::PAGE_SIZE_DEFAULT, $page, $queryArray, ['category'=>true,'grade'=>true,'categoryUnit'=>true]);
        return view('thresholds.list',
            [
                'thresholds' => $responses['data']??[],
                'boxTitle' => '告警阈值列表',
                'active' => 'thresholds',
            ]
        );
    }

    public function edit($id){
        $thresholdResponses = $this->thresholdsServices->getInfoClient($this->thresholdsServices->getRetrieveByIdUrl(),['id'=>$id]);
        $patterns   = $this->thresholdsServices->getPattern();
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        $patternStatus = $this->thresholdsServices->getPatternStatus($thresholdResponses['data']);
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getUrl(),[]);

        return view('thresholds.edit',
            [
                'route' => '/api/admin/thresholds/edit/'.$id,
                'getEquipmentUrl' => route('api.equipments.getEquipments'),
                'getCollectorUrl' => route('api.collectors.getCollectors'),
                'boxTitle'=> '修改告警阈值',
                'active' => 'thresholds',
                'threshold' => $thresholdResponses['data'],
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
                'patternStatus' => $patternStatus,
                'companies' => $companyResponses['data'],
            ]
        );
    }

    public function store(){
        $patterns   = $this->thresholdsServices->getPattern();
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getUrl(),[]);
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
                'companies' => $companyResponses['data'],
            ]
        );
    }


}
