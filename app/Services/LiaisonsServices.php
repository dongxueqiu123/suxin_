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
        $this->companiesServices = new CompaniesServices();
    }

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->liaisons->nothing();

        foreach($queryArray as $key => $value){
            if($key === 'firmId'){
                //没有特殊权限的正常判断
                if(!$this->companiesServices->isHavePermission($value)){
                    $value && $query->firmId($value);
                }
            }
        }

        $liaisons = $pageSize === 0?$query->get(): $query->paginate($pageSize);
        return $liaisons;
    }

    function getAll(){
        return $this->liaisons::all();
    }

    public function save(array $modelData){
        if(isset($modelData['id'])){
            $this->liaisons = $this->get($modelData['id']);
        }
        ($modelData['companyId']??'') && $this->liaisons->firm_id = $modelData['companyId'];
        ($modelData['equipmentId']??'') && $this->liaisons->equipment_id = $modelData['equipmentId'];
        ($modelData['collectorId']??'') && $this->liaisons->collector_id = $modelData['collectorId'];
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