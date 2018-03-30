<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\Role;
use App\Eloquent\EquipmentsModel;
use App\Eloquent\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EquipmentsController extends Controller
{

    public function __construct()
    {
        $this->equipments = new EquipmentsModel();
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
        if($state = $this->equipments::where('id',$id)->delete()){
            return response()->json([
                'state' => $state,
                'route' => route('equipments')
            ]);
        }
    }



}
