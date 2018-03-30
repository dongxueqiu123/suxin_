<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午4:50
 */
namespace App\Http\Controllers\Api;

use App\Services\LiaisonsServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiaisonsController extends Controller{

    public function __construct()
    {
        $this->LiaisonsServices = new LiaisonsServices();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $request->validate([
            'pattern'=>'required',
            'patternId' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);
        $input = $request->only(['pattern','patternId', 'mobile', 'email']);
        $input['id'] = $id;
        if($state = $this->LiaisonsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('liaisons')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'pattern'=>'required',
            'patternId' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);
        $input = $request->only(['pattern','patternId', 'mobile', 'email']);
        if($state = $this->LiaisonsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('liaisons')
            ]);
        }
    }

    public function delete($id){
        if($state = $this->LiaisonsServices->destroy($id)){
            return response()->json([
                'state' => $state,
                'route' => route('liaisons')
            ]);
        }
    }
}