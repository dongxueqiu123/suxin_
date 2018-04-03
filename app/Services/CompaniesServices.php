<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午1:18
 */
namespace App\Services;

use App\Eloquent\CompaniesModel;

class CompaniesServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $companies;
    public function init(){
        $this->companies = new CompaniesModel();
    }

    function getAll(){
        return $this->companies::all();
    }

    public function isUserInCompany($company, $user){
        $boole = false;
        $companyId = $user->company->id??'';
        if(($company->id??'') == $companyId || empty($companyId)){
             $boole = true;
        }
        return $boole;
    }

    public function getModelsByCompany($models){
        $companyId = \Auth()->user()->company->id??'';
        foreach ($models as $model){
            //if(($model->pattern_id == 0)||($model->company->id??'') == $companyId){
            if(($model->company->id??'') == $companyId){

                $thresholdModels[] = $model;

            }
        }
        return $thresholdModels??[];
    }
}