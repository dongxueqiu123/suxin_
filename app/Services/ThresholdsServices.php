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

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->thresholds->nothing();

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

    public function getChName($thresholds){
        foreach ($thresholds as $threshold){
            $threshold->pattern  = $this->getConstant($threshold,'pattern');
            $threshold->category = $this->getConstant($threshold,'category');
            $threshold->grade    = $this->getConstant($threshold,'grade');
        }
        return $thresholds;
    }

}
?>