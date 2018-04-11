<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 2018/3/30
 * Time: 10:10
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\CollectorsModel;
use App\Eloquent\ThresholdsModel;
use App\Services\CollectorsServices;
use App\Services\EquipmentsServices;
use App\Services\CompaniesServices;
use App\Services\ThresholdsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThresholdsController extends Controller
{

    public function __construct()
    {
        $this->equipmentsServices = new EquipmentsServices();
        $this->collectorsServices = new CollectorsServices();
        $this->companiesServices  = new CompaniesServices();
        $this->thresholdsServices = new ThresholdsServices();
        $this->thersholes = new ThresholdsModel();
        $this->collectors = new CollectorsModel();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $request->validate([
            'category' => 'required',
            'grade' => 'required',
            'companyId' => 'required',
            'equipmentId' => 'required'
        ]);
        $input = $request->only(['category', 'grade', 'lowLimit', 'topLimit','companyId','equipmentId','collectorId']);
        $input['id'] = $id;
        if($state = $this->thresholdsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('thresholds')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'category' => 'required',
            'grade' => 'required',
            'companyId' => 'required',
            'equipmentId' => 'required'
        ]);
        $input = $request->only(['category', 'grade', 'lowLimit', 'topLimit','companyId','equipmentId','collectorId']);

        if($state = $this->thresholdsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('thresholds')
            ]);
        }
    }

    public function delete($id){
        if($state = $this->thresholdsServices->destroy($id)){
            return response()->json([
                'state' => $state,
                'route' => route('thresholds')
            ]);
        }
    }

    public function getPatterns(Request $request){
       $pattern   = $request->input('pattern');
       $patternId = $request->input('patternId');
       $user = \Auth()->user();
       $patternsInfo = [];
       if($pattern == 'firm_id'){
           $patternsInfo = $this->companiesServices->getAll();
           foreach ($patternsInfo as $key => $patternInfo){
              $boole = $this->companiesServices->isUserInCompany($patternInfo,$user);
              if(!$boole)
                   unset($patternsInfo[$key]);
           }
       }elseif($pattern == 'equipment_id'){
           $patternsInfo = $this->equipmentsServices->getAll();
           foreach ($patternsInfo as $key => $patternInfo){
               $boole = $this->equipmentsServices->isUserInEquipment($patternInfo,$user);
               if(!$boole)
                   unset($patternsInfo[$key]);
           }
       }elseif($pattern == 'collector_id'){
           $patternsInfo = $this->collectorsServices->getAll();
           foreach ($patternsInfo as $key => $patternInfo){
               $boole = $this->collectorsServices->isUserInCollector($patternInfo,$user);
               if(!$boole)
                   unset($patternsInfo[$key]);
           }
       }
       $str ='';

       foreach ($patternsInfo??[] as $patternInfo){
           $selected =  ($patternId == $patternInfo->id)?'selected':'';
           $str.= '<option '.$selected.' value="'.$patternInfo->id.'">'.$patternInfo->name.'</option>';
       }
       return ['state'=>0,'text' => $str];
    }


}
