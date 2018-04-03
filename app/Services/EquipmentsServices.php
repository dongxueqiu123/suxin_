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

    function getAll(){
        return $this->equipments::all();
    }

    public function isUserInEquipment($equipment, $user){
        $boole = false;
        $companyId = $user->company->id??'';
        if($equipment->provider->id == $companyId|| empty($companyId)){
            $boole = true;
        }elseif($equipment->consumer->id == $companyId|| empty($companyId)){
            $boole = true;
        }
        return $boole;
    }

    public function getModelsByEquipment($items){
        $companyId = \Auth()->user()->company->id??'';
        foreach ($items as $item){
            $pattern = $item->pattern;
            $providerCompanyId = $item->equipment->provider->id??'';
            $consumerCompanyId = $item->equipment->consumer->id??'';
            if($pattern == 2 && $providerCompanyId == $companyId){
                $providerItems[] = $item;
            }
            if($pattern == 2 && $consumerCompanyId == $companyId){
                $consumerItems[] = $item;
            }
        }
        return  array_merge($providerItems??[],$consumerItems??[]);
    }
}