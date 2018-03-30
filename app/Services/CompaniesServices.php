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
}