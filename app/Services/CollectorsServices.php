<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午1:14
 */
namespace App\Services;

use App\Eloquent\CollectorsModel;

class CollectorsServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $collectors;
    public function init(){
        $this->collectors = new CollectorsModel();
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
        return $this->collectors::all();
    }

    public function get($id){
        $collector = $this->collectors::find($id);
        return $collector;
    }

    public function isUserInCollector($collector, $user){
        $boole = false;
        $companyId = $user->company->id??'';
        if($collector->pattern??'' == 1){
            if(($collector->company->id??'') == $companyId || empty($companyId)){
                $boole = true;
            }
        }elseif($collector->pattern??'' == 2){
            if(($collector->company->id??'')  == $companyId || empty($companyId)){
                $boole = true;
            }
            if(($collector->company->id??'')  == $companyId || empty($companyId)){
                $boole = true;
            }
        }
        return $boole;
    }

    public function getModelsByCollector($models, $modelPattern = 3){
        $companyId = \Auth()->user()->company->id??'';
        foreach ($models as $model){
            $pattern = $model->pattern??'';
            $collectorPattern = $model->collector->pattern??'';
            if($pattern == $modelPattern && $collectorPattern == 1){
                if(($model->collector->company->id??'') == $companyId){
                    $collectorCompanyModel[] = $model;
                }
            }elseif($pattern == $modelPattern && $collectorPattern == 2){
                if(($model->collector->equipment->provider->id??'') == $companyId){
                    $collectorProviderModel[] = $model;
                }
                if(($model->collector->equipment->consumer->id??'') == $companyId){
                    $collectorConsumerModel[] = $model;
                }
            }
        }
        return array_merge($collectorCompanyModel??[],$collectorProviderModel??[],$collectorConsumerModel??[]);
    }
}