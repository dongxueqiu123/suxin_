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
        $request->validate([
            'mac'=>'required|between:23,23',
            'name' => 'required',
            'companyId' => 'required',
        ]);
        $input = $request->only(['mac','name','companyId','equipmentId']);
        $input['id'] = $id;
        if($state = $this->collectorsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('collectors')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'mac'=>'required|between:23,23',
            'name' => 'required',
            'companyId' => 'required',
        ]);
        $input = $request->only(['mac','name','companyId','equipmentId']);
        //$ids =  $this->thresholdsServices->getBelongIds($pattern,$patternId);
        if($state = $this->collectorsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('collectors')
            ]);
        }
    }

    public function delete($id){
        if($state = $this->collectorsServices->destroy($id)){
            return response()->json([
                'state' => $state,
                'route' => route('collectors')
            ]);
        }
    }


    public function getCollectors(Request $request){
        $companyId = $request->input('companyId');
        $equipmentId = $request->input('equipmentId');
        $collectorId = $request->input('collectorId');
        $company =  $this->companiesServices->get($companyId);
        if($equipmentId){
            $equipment = $this->equipmentsServices->get($equipmentId);
            $collectors = $equipment->collector??[];
        }else{
            //公司下所有的采集器
            $companyCollectors = $company->collector??collect();
            //公司设备下所有的采集器
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
            //直接绑定公司的采集器
            $collectors = $companyCollectors->diff($equipmentCollectors);
        }
        /*todo 增加公司权限控制*/
        $str ='';
        $str.= '<option value=0 >不选择</option>';
        foreach ($collectors??[] as $collector){
            $selected =  ($collectorId == $collector->id)?'selected':'';
            $str.= '<option '.$selected.' value="'.$collector->id.'">'.$collector->name.'</option>';
        }
        return ['state'=>0,'text' => $str];
    }
}
