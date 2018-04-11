<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午1:14
 */
namespace App\Services;

use App\Eloquent\CollectorsModel;
use App\Services\CompaniesServices;
use App\Services\EquipmentsServices;
use Illuminate\Support\Facades\Auth;

class CollectorsServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $collectors,$companiesServices,$equipmentsServices;
    public function init(){
        $this->collectors = new CollectorsModel();
        $this->companiesServices = new CompaniesServices();
        $this->equipmentsServices = new EquipmentsServices();
    }


    /**
     * 获取posts列表
     */
    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->collectors->nothing();

        foreach($queryArray as $key => $value){
            if($key === 'firmId'){
                $value && $query->firmId($value);
            } else if ($key === 'equipmentId') {
                $value && $query->equipmentId($value);
            }
        }

        $lines = $query->get();
        return $lines;
    }

    function getAll(){
        return $this->collectors::all();
    }

    public function get($id){
        $collector = $this->collectors::find($id);
        return $collector;
    }

    public function save(array $modelData)
    {
        if(isset($modelData['id'])){
            $this->collectors = $this->get($modelData['id']);
        }
        $this->collectors->mac = $modelData['mac'];
        $this->collectors->name = $modelData['name'];
        $this->collectors->producer_id = '1';
        ($modelData['companyId']??'') && $this->collectors->firm_id = $modelData['companyId'];
        ($modelData['equipmentId']??'') && $this->collectors->equipment_id = $modelData['equipmentId'];
        $this->collectors->operator_id = Auth::user()->id;
        $state = $this->collectors->save();
        return $state;
    }

    public function destroy($id)
    {
        return $this->collectors::where('id',$id)->delete();
    }

    /**
     * 获取工厂和机械设备下得采集器
     * @param $items $user
     * @return array
     */
    public function getCompanyAndEquipmentCollectors($collectors, $user){
        $result = [];
        foreach ($collectors as $collector){
            if($this->equipmentsServices->isHaveEquipmentId($collector) && $this->equipmentsServices->isUserInEquipment($collector->equipment, $user)){
                $result['equipment'][] = $collector;
            }elseif($this->companiesServices->isHaveFirmId($collector) && $this->companiesServices->isUserInCompany($collector->company, $user)){
                $result['company'][] = $collector;
            }
        }
        return $result;
    }

    public function isUserInCollector($collector, $user){
        $inCollector = false;
        $companyId = $user->company->id??'';
        if(($collector->company->id??'') == $companyId || empty($companyId)){
            $inCollector = true;
        }elseif(($collector->equipment->provider->id??'')  == $companyId || empty($companyId)){
            $inCollector = true;
        }elseif(($collector->equipment->consumer->id??'')  == $companyId || empty($companyId)){
            $inCollector = true;
        }
        return $inCollector;
    }

    public function isHaveCollector($item){
        $haveCollector = false;
        if($item->collector_id){
            $haveCollector = true;
        }
        return $haveCollector;
    }

}