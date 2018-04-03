<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 上午9:46
 */
namespace App\Services;

use App\Eloquent\AlarmsModel;
use Illuminate\Support\Facades\Auth;

class AlarmsServices extends ServicesAdapte{
    public function __construct(){
        $this->init();
    }

    private $alarms;
    public function init(){
        $this->alarms = new AlarmsModel();
    }

    function getAll(){
        return $this->alarms::all();
    }

    public function save($modelData){
        if(isset($modelData['id'])){
            $this->alarms = $this->get($modelData['id']);
        }
        $this->alarms->status   = $modelData['status'];
        if(isset($modelData['remark']))
            $this->alarms->remark = $modelData['remark'];
        $state = $this->alarms->save();
        return $state;
    }

    public function get($id){
        $alarms = $this->alarms::find($id);
        return $alarms;
    }
}