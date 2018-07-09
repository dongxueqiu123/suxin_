<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\CompaniesModel;
use App\Eloquent\UsersModel;
use Illuminate\Http\Request;
use App\Services\CompaniesServices;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->companies = new CompaniesModel();
        $this->companiesServices = new CompaniesServices();
        $this->users = new UsersModel();
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request){
        $input = $request->only(['name']);
        $input['id'] = $id;
        //$this->companiesServices->postClient($this->companiesServices->getSaveUrl(),$input);
        if($state = $this->companiesServices->postClient($this->companiesServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('companies'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function store(Request $request){
        $input = $request->only(['name','userId']);

        if($state = $this->companiesServices->postClient($this->companiesServices->getSaveUrl(),$input)){
            return response()->json([
                'state' => $state['code'],
                'route' => route('companies'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }

    public function delete($id){
        if($state = $this->companiesServices->postClient($this->companiesServices->getDeleteUrl(),['id'=>$id])){
            return response()->json([
                'state' => $state['code'],
                'route' => route('companies'),
                'info'  => config('code.'.$state['code'])
            ]);
        }
    }
}
