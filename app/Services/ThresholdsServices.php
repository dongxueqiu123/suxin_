<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 上午10:20
 */
namespace App\Services;

use App\Eloquent\ThresholdsModel;
use App\Services\CompaniesServices;
use App\Services\EquipmentsServices;
use App\Services\CollectorsServices;
use Illuminate\Support\Facades\Auth;

class ThresholdsServices extends ServicesAdapte {

    public function __construct(){
        $this->init();
    }

    private $thresholds,$companiesServices,$equipmentsServices,$collectorsServices;
    public function init(){
        $this->thresholds = new ThresholdsModel();
        $this->companiesServices = new CompaniesServices();
        $this->equipmentsServices = new EquipmentsServices();
        $this->collectorsServices = new CollectorsServices();
    }

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->thresholds->nothing();

        foreach($queryArray as $key => $value){
            if($key === 'pattern'){
                $value && $query->pattern($value);
            } else if ($key === 'patternId') {
                $value && $query->patternId($value);
            }
        }

        $lines = $query->get();
        return $lines;
    }

    function getAll(){
        return $this->thresholds::all();
    }

    public function save(array $modelData){
        if(isset($modelData['id'])){
            $this->thresholds = $this->get($modelData['id']);
        }
        ($modelData['companyId']??'') && $this->thresholds->firm_id = $modelData['companyId'];
        ($modelData['equipmentId']??'') && $this->thresholds->equipment_id = $modelData['equipmentId'];
        ($modelData['collectorId']??'') && $this->thresholds->collector_id = $modelData['collectorId'];
        $this->thresholds->category = $modelData['category'];
        $this->thresholds->grade    = $modelData['grade'];
        $this->thresholds->lowLimit = $modelData['lowLimit'];
        $this->thresholds->topLimit = $modelData['topLimit'];
        $this->thresholds->operator_id = Auth::user()->id;
        $state = $this->thresholds->save();
        return $state;
    }

    public function get($id){
        $thresholds = $this->thresholds::find($id);
        return $thresholds;
    }

    public function destroy($id){
        $result = $this->thresholds::where('id',$id)->delete();
        return $result;
    }

    public function getConstant($model,$name){
        $id = empty($model)?$model:($model->$name??null);
        $name ='get'.($name);
        return  $this->thresholds->$name($id);
    }

    public function getChName($thresholds){
        foreach ($thresholds as $threshold){
            $threshold->pattern  = $this->getConstant($threshold,'pattern');
            $threshold->category = $this->getConstant($threshold,'category');
            $threshold->grade    = $this->getConstant($threshold,'grade');
        }
        return $thresholds;
    }

    public function getPattern(array $excepts = []){
       return $this->thresholds->getPattern($excepts);
    }

    public function getPatternStatus($model){
        return $this->thresholds->getPatternStatus($model);
    }

    /**
     * 获取工厂和机械设备下得采集器
     * @param $items $user
     * @return array
     */
    public function getFilterThresholds($thresholds, $user){
        $result = [];
        $result['equipment'] = [];
        $result['company'] = [];
        $result['collector'] = [];
        foreach ($thresholds as $threshold){
            if($this->collectorsServices->isHaveCollector($threshold) && $this->collectorsServices->isUserInCollector($threshold->collector, $user)){
                $result['collector'][] = $threshold;
            }elseif($this->equipmentsServices->isHaveEquipmentId($threshold) && $this->equipmentsServices->isUserInEquipment($threshold->equipment, $user)){
                $result['equipment'][] = $threshold;
            }elseif($this->companiesServices->isHaveFirmId($threshold) && $this->companiesServices->isUserInCompany($threshold->company, $user)){
                $result['company'][] = $threshold;
            }
        }
        return $result;
    }

    public function getBelongIds($belongName, $id){
        $result = [];
        $firm = $this->thresholds->getFirmName();
        $equipment = $this->thresholds->getEquipmentName();
        $collector =  $this->thresholds->getCollectorName();
        $result[$firm]  = '';
        $result[$equipment]  = '';
        $result[$collector]  = '';
        if($belongName == $firm){
            $result[$firm] = $id;
        }elseif($belongName == $equipment){
            $result[$equipment] = $id;
            $equipment = $this->equipmentsServices->get($id);
            //消费厂家的id
            $result[$firm] = $equipment->consumer->id??0;
        }elseif($belongName == $collector){
            $result[$collector]  = $id;
            $collector = $this->collectorsServices->get($id);
            $result[$equipment] = $collector->equipment->id??0;
            $result[$firm] = $collector->company->id??0;
        }
        return $result;
    }
}
?>