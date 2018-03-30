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


    function getAll(){
        return $this->collectors::all();
    }
}