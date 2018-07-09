<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CollectorsServices;
use App\Services\ThresholdsServices;
use App\Services\EquipmentsServices;
use App\Services\CompaniesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CollectorsController extends Controller
{

    public function __construct()
    {
        $this->collectorsServices = new CollectorsServices();
        $this->thresholdsServices = new ThresholdsServices();
        $this->equipmentsServices = new EquipmentsServices();
        $this->companiesServices  = new CompaniesServices();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){

        $input = $request->only(['mac','name','firmId','equipmentId','operatorId','latitude','longitude','cityName','provinceName']);
        $input['id'] = $id;
        $input['firmId'] = $input['firmId']??0;
        $input['equipmentId'] = $input['equipmentId']??0;

        if($state = $this->collectorsServices->postClient($this->collectorsServices->getEditUrl(),$input)){
            return response()->json([
                'code' => $state['code'],
                'route' => route('collectors'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function store(Request $request){

        $input = $request->only(['mac','name','firmId','equipmentId','operatorId','latitude','longitude','cityName','provinceName']);
        $input['companyId'] = $input['companyId']??0;
        $input['equipmentId'] = $input['equipmentId']??0;

        if($state = $this->collectorsServices->postClient($this->collectorsServices->getSaveUrl(),$input)){

            return response()->json([
                'code' => $state['code'],
                'route' => route('collectors'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function delete($id){
        $input['id'] = $id;
        if($state = $this->collectorsServices->postClient($this->collectorsServices->getDeleteUrl(),$input)){
            return response()->json([
                'code' => $state['code'],
                'route' => route('collectors'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }


    public function getCollectors(Request $request){
        $companyId = $request->input('companyId');
        $equipmentId = $request->input('equipmentId');
        $collectorId = $request->input('collectorId');
        //$company =  $this->companiesServices->get($companyId);
    /*    if($equipmentId){
            $equipment = $this->equipmentsServices->get($equipmentId);
            $collectors = $equipment->collector??[];
        }else{

            //公司下所有的无线节点
            $companyCollectors = $company->collector??collect();
            //公司设备下所有的无线节点
            $providerEquipments = $company->provider??collect();
            $consumerEquipments = $company->consumer??collect();
            $equipments = $providerEquipments->merge($consumerEquipments)->unique();
            $equipmentCollectors = collect();
            $equipments->each(function($equipment) use($equipmentCollectors){
                $equipmentCollector = $equipment->collector;
                $equipmentCollector->each(function($equipmentCollector)use($equipmentCollectors){
                    $equipmentCollectors->push($equipmentCollector);
                });
            });
            //直接绑定公司的无线节点
            $collectors = $companyCollectors->diff($equipmentCollectors);
        }*/
        $collectorResponses = $this->collectorsServices->getInfoClient($this->collectorsServices->getUrl(),['firmId'=>$companyId,'equipmentId'=>$equipmentId]);
        $collectors = $collectorResponses['data'];

        /*todo 增加公司权限控制*/
        $str ='';
        $str.= '<option value=0 >不选择</option>';
        foreach ($collectors??[] as $collector){
            $selected =  ($collectorId == $collector['id'])?'selected':'';
            $str.= '<option '.$selected.' value="'.$collector['id'].'">'.$collector['name'].'</option>';
        }
        return ['state'=>0,'text' => $str];
    }
}
