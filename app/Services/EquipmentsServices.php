<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午1:17
 */
namespace App\Services;

use App\Eloquent\EquipmentsModel;
use Illuminate\Support\Facades\Auth;

class EquipmentsServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $equipments;
    public function init(){
        $this->equipments = new EquipmentsModel();
    }

    /**
     * 获取posts列表
     */
    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->equipments->nothing();

        foreach($queryArray as $key => $value){
            if($key === 'providerId'){
                $value && $query->providerId($value);
            } else if ($key === 'consumerId') {
                $value && $query->consumerId($value);
            }
        }

        $lines = $query->get();
        return $lines;
    }

    public function getAll(){
        return $this->equipments::all();
    }

    public function destroy($id)
    {
       return $this->equipments::where('id',$id)->delete();
    }

    public function get($id){
        $equipment = $this->equipments::find($id);
        return $equipment;
    }

    /**
     * 是否是一个公司的机械设备下
     * @param $equipment
     * @param $user
     * @return bool
     */
    public function isUserInEquipment($equipment, $user){
        $inEquipment= false;
        $companyId = $user->company->id??'';
        if(($equipment->provider->id??'') == $companyId|| empty($companyId)){
            $inEquipment = true;
        }elseif(($equipment->consumer->id??'') == $companyId|| empty($companyId)){
            $inEquipment = true;
        }
        return $inEquipment;
    }

    /**
     * 是否存在机械编号
     * @param $item
     * @return bool
     */
    public function isHaveEquipmentId($item){
        $haveEquipmentId = false;
        if($item->equipment_id){
            $haveEquipmentId = true;
        }
        return $haveEquipmentId;
    }

}