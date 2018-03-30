<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 上午10:20
 */
namespace App\Services;

use App\Eloquent\ThresholdsModel;
use Illuminate\Support\Facades\Auth;

class ThresholdsServices extends ServicesAdapte {

    public function __construct(){
        $this->init();
    }

    private $thresholds;
    public function init(){
        $this->thresholds = new ThresholdsModel();
    }

    function getAll(){
        return $this->thresholds::all();
    }

    public function save($modelData){
        if(isset($modelData['id'])){
            $this->thresholds = $this->get($modelData['id']);
        }
        $this->thresholds->pattern   = $modelData['pattern'];
        $this->thresholds->pattern_id = $modelData['patternId'];
        $this->thresholds->category  = $modelData['category'];
        $this->thresholds->grade     = $modelData['grade'];
        $this->thresholds->lowLimit  = $modelData['lowLimit'];
        $this->thresholds->topLimit  = $modelData['topLimit'];
        $this->thresholds->operator_id = Auth::user()->id;
        $state = $this->thresholds->save();
        return $state;
    }

    public function get($id){
        $thresholds = $this->thresholds::find($id);
        return $thresholds;
    }

    public function destroy($id){
        $result = $this->thresholds::where('id',$id)->delete();
        return $result;
    }

    public function getConstant($model,$name){
        $id = empty($model)?$model:($model->$name??null);
        $name ='get'.($name);
        return  $this->thresholds->$name($id);
    }
}
?>