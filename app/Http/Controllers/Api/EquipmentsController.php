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
        $request->validate([
            'name' => 'required',
            'providerId' => 'required',
            'consumerId' => 'required',
        ]);
        $equipment = $this->equipments::find($id);
        $input = $request->only(['name', 'providerId', 'consumerId']);
        $equipment->name = $input['name'];
        $equipment->provider_id = $input['providerId'];
        $equipment->consumer_id = $input['consumerId'];
        if($state = $equipment->save()){
            return response()->json([
                'state' => $state,
                'route' => route('equipments')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'providerId' => 'required',
            'consumerId' => 'required',
        ]);
        $input = $request->only(['name', 'providerId', 'consumerId']);
        $this->equipments->name = $input['name'];
        $this->equipments->provider_id = $input['providerId'];
        $this->equipments->consumer_id = $input['consumerId'];
        $this->equipments->operator_id = Auth::user()->id;
        if($state = $this->equipments->save()){
            return response()->json([
                'state' => $state,
                'route' => route('equipments')
            ]);
        }
    }

    public function delete($id){
        if($state = $this->equipmentsServices->destroy($id)){
            return response()->json([
                'state' => $state,
                'route' => route('equipments')
            ]);
        }
    }

    public function getEquipments(Request $request){
        $companyId = $request->input('companyId');
        $equipmentId = $request->input('equipmentId');
        $company =  $this->companiesServices->get($companyId);
        $providerEquipments = $company->provider;
        $consumerEquipments = $company->consumer;
        $equipments = $providerEquipments->merge($consumerEquipments)->unique();
        /*todo 增加公司权限控制*/
        $str ='';
        $str.= '<option value=0 >不选择</option>';
        foreach ($equipments??[] as $equipment){

            $selected =  ($equipmentId == $equipment->id)?'selected':'';
            $str.= '<option '.$selected.' value="'.$equipment->id.'">'.$equipment->name.'</option>';
        }
        return ['state'=>0,'text' => $str];
    }

}
