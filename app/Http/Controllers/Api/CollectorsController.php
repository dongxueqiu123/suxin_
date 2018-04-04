<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\CollectorsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CollectorsController extends Controller
{

    public function __construct()
    {
        $this->collectors = new CollectorsModel();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $request->validate([
            'mac'=>'required|between:23,23',
            'name' => 'required',
            'pattern' => 'required',
        ]);
        $collector = $this->collectors::find($id);
        $input = $request->only(['mac','name', 'pattern', 'patternId']);
        //$input['patternId'] = $input['pattern'] == 1 ? (Auth::user()->company->id??0):$input['patternId'];
        $collector->mac = $input['mac'];
        $collector->name = $input['name'];
        $collector->pattern = $input['pattern'];
        $collector->pattern_id = $input['patternId'];
        if($state = $collector->save()){
            return response()->json([
                'state' => $state,
                'route' => route('collectors')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'mac'=>'required|between:23,23',
            'name' => 'required',
            'pattern' => 'required',
        ]);
        $input = $request->only(['mac','name', 'pattern', 'patternId']);
        //$input['patternId'] = $input['pattern'] == 1 ? (Auth::user()->company->id??0):$input['patternId'];
        $this->collectors->mac = $input['mac'];
        $this->collectors->name = $input['name'];
        $this->collectors->pattern = $input['pattern'];
        $this->collectors->pattern_id = $input['patternId'];
        $this->collectors->operator_id = Auth::user()->id;
        if($state = $this->collectors->save()){
            return response()->json([
                'state' => $state,
                'route' => route('collectors')
            ]);
        }
    }

    public function delete($id){
        if($state = $this->collectors::where('id',$id)->delete()){
            return response()->json([
                'state' => $state,
                'route' => route('equipments')
            ]);
        }
    }

}
