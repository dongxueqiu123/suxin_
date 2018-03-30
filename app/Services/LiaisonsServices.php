<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午4:43
 */
namespace App\Services;

use App\Eloquent\LiaisonsModel;
use Illuminate\Support\Facades\Auth;

class LiaisonsServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $thresholds;
    public function init(){
        $this->liaisons = new LiaisonsModel();
    }

    function getAll(){
        return $this->liaisons::all();
    }

    public function save($modelData){
        if(isset($modelData['id'])){
            $this->liaisons = $this->get($modelData['id']);
        }
        $this->liaisons->pattern    = $modelData['pattern'];
        $this->liaisons->pattern_id = $modelData['patternId'];
        $this->liaisons->email      = $modelData['email'];
        $this->liaisons->mobile     = $modelData['mobile'];
        $this->liaisons->operator_id = Auth::user()->id;
        $state = $this->liaisons->save();
        return $state;
    }

    public function get($id){
        $thresholds = $this->liaisons::find($id);
        return $thresholds;
    }

    public function destroy($id){
        $result = $this->liaisons::where('id',$id)->delete();
        return $result;
    }
}