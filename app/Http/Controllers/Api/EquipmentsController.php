<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\EquipmentsModel;
use App\Services\EquipmentsServices;
use App\Services\CompaniesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EquipmentsController extends Controller
{

    public function __construct()
    {
        $this->equipments = new EquipmentsModel();
        $this->equipmentsServices = new EquipmentsServices();
        $this->companiesServices = new CompaniesServices();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){

        $input = $request->only(['name', 'providerId', 'consumerId']);
        $input['id'] = $id;
        $input['operatorId'] = Auth::user()->id;
        if($state = $this->equipmentsServices->postClient($this->equipmentsServices->getSaveUrl(),$input)){
            return response()->json([
                'code' => $state['code'],
                'route' => route('equipments'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function store(Request $request){

        $input = $request->only(['name', 'providerId', 'consumerId']);
        $input['operatorId'] = Auth::user()->id;
        if($state = $this->equipmentsServices->postClient($this->equipmentsServices->getSaveUrl(),$input)){
            return response()->json([
                'code' => $state['code'],
                'route' => route('equipments'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function delete($id){
        if($state = $this->equipmentsServices->postClient($this->equipmentsServices->getDeleteUrl(),['id'=>$id])){
            return response()->json([
                'code' => $state['code'],
                'route' => route('equipments'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function getEquipments(Request $request){
        $companyId = $request->input('companyId');
        $equipmentId = $request->input('equipmentId');
        //$this->companiesServices->getInfoClient($this->equipmentsServices->getUrl(),['id'=>$companyId]);
/*        $company =  $this->companiesServices->get($companyId);
        dump($company);die;*/
        $equipmentResponses = $this->equipmentsServices->getInfoClient($this->equipmentsServices->getUrl(),['firmId'=>$companyId]);
        $equipments = $equipmentResponses['data'];
        /*todo 增加公司权限控制*/
        $str ='';
        $str.= '<option value=0 >不选择</option>';
        foreach ($equipments??[] as $equipment){

            $selected =  ($equipmentId == $equipment['id'])?'selected':'';
            $str.= '<option '.$selected.' value="'.$equipment['id'].'">'.$equipment['name'].'</option>';
        }
        return ['state'=>0,'text' => $str];
    }

}
