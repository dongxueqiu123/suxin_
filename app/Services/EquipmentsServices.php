<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午1:17
 */
namespace App\Services;

use App\Eloquent\EquipmentsModel;

class EquipmentsServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $equipments;
    public function init(){
        $this->equipments = new EquipmentsModel();
    }


    function getAll(){
        return $this->equipments::all();
    }
}