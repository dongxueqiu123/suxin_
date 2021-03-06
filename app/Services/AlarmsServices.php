<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 上午9:46
 */
namespace App\Services;

use App\Eloquent\AlarmsModel;
use App\Eloquent\ApiModuleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class AlarmsServices extends ServicesAdapte{
    public function __construct(){
        $this->init();
    }

    private $alarms,$companiesServices,$equipmentsServices,$collectorsServices;
    public function init(){
        $this->alarms = new AlarmsModel();
        $this->companiesServices = new CompaniesServices();
        $this->equipmentsServices = new EquipmentsServices();
        $this->collectorsServices = new CollectorsServices();
        $this->thresholdsServices = new ThresholdsServices();
    }

    /**
     * 获取posts列表
     */
    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){
        $query = $this->alarms->nothing();
        ($ext['latest'] ?? 0) && $query->latest();
        foreach($queryArray as $key => $value){
            if($key === 'firmId'){
                //没有特殊权限的正常判断
                if(!$this->companiesServices->isHavePermission($value)){
                    $value && $query->firmId($value);
                }
            }
        }

        $alarms = $pageSize === 0?$query->get(): $query->paginate($pageSize);
        return $alarms;
    }

    function getAll(){
        return $this->alarms::all();
    }

    public function save(array $modelData){
        if(isset($modelData['id'])){
            $this->alarms = $this->get($modelData['id']);
        }
        $this->alarms->status   = $modelData['status'];
        if(isset($modelData['remark']))
            $this->alarms->remark = $modelData['remark'];
        $state = $this->alarms->save();
        return $state;
    }

    /**
     * 获取工厂和机械设备下得无线节点
     * @param $items $user
     * @return array
     */
    public function getFilterAlarms($alarms, $user){
        $result = [];
        $result['equipment'] = [];
        $result['company'] = [];
        $result['collector'] = [];
        $consumer = [];
        $provider = [];

        foreach ($alarms as $alarm){
            if($this->collectorsServices->isHaveCollector($alarm) && $this->collectorsServices->isUserInCollector($alarm->collector, $user)){
                $result['collector'][] = $alarm;
            }elseif($this->equipmentsServices->isHaveEquipmentId($alarm) && $this->equipmentsServices->isUserInEquipment($alarm->equipment, $user)){
                $result['equipment'][] = $alarm;
            }elseif($this->companiesServices->isHaveFirmId($alarm) && $this->companiesServices->isUserInCompany($alarm->consumer, $user)){
                $consumer[] = $alarm;
            }elseif($this->companiesServices->isHaveFirmId($alarm) && $this->companiesServices->isUserInCompany($alarm->provider, $user)){
                $provider[] = $alarm;
            }
        }
        $result['company'] = array_merge($consumer,$provider);
        return $result;
    }

    public function get($id){
        $alarms = $this->alarms::find($id);
        return $alarms;
    }

    public function pagination($collectors,$count,$pageSize,$pagination){
        return new LengthAwarePaginator($collectors,$count,$pageSize,$pagination,['path'=>'']);
    }

    public function getUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_RETRIEVEALARM;
    }

    public function getRecoverUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_RETRIEVEBYPARAMS;
    }

    public function getCountUrl($id){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_COUNT.'/'.$id;
    }

    public function getCountAlarmUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_COUNTALARM;
    }

    public function getUpadateByIdUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_UPDATEBYID;
    }
}