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
            'pattern'=>'required',
            'patternId' => 'required',
            'category' => 'required',
            'grade' => 'required',
        ]);
        $input = $request->only(['pattern','patternId', 'category', 'grade', 'lowLimit', 'topLimit']);
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
            'pattern'=>'required',
            'patternId' => 'required',
            'category' => 'required',
            'grade' => 'required',
        ]);
        $input = $request->only(['pattern','patternId', 'category', 'grade', 'lowLimit', 'topLimit']);
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
       $patternsInfo = [];
       if($pattern == '1'){
           $patternsInfo = $this->companiesServices->getAll();
       }elseif($pattern == '2'){
           $patternsInfo = $this->equipmentsServices->getAll();
       }elseif($pattern == '3'){
           $patternsInfo = $this->collectorsServices->getAll();
       }
       $str ='';

       foreach ($patternsInfo as $patternInfo){
           $selected =  ($patternId == $patternInfo->id)?'selected':'';
           $str.= '<option '.$selected.' value="'.$patternInfo->id.'">'.$patternInfo->name.'</option>';
       }
       return ['state'=>0,'text' => $str];
    }


}
