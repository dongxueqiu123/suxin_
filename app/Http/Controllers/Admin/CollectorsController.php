<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\UsersModel;
use App\Eloquent\Role;
use App\Eloquent\RoleUserModel;
use App\Eloquent\EquipmentsModel;
use App\Eloquent\CollectorsModel;
use App\Http\Controllers\Controller;

class CollectorsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->collectors = new CollectorsModel();
        $this->equipments = new EquipmentsModel();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $collectors = $this->collectors::all();
        return view('collectors.list',
            [
                'collectors' => $collectors,
                'boxTitle'=>'采集设备列表',
                'active' => 'collectors'
            ]
        );
    }

    public function edit($id){
        $collector = $this->collectors::where('id','=',$id)->first();
        $equipments = $this->equipments::get();
        return view('collectors.edit',
            [
                'collector' => $collector,
                'route' => '/api/admin/collectors/edit/'.$id,
                'boxTitle'=> '修改采集设备',
                'active' => 'collectors',
                'equipments' => $equipments
            ]
        );
    }

    public function store(){
        $equipments = $this->equipments::get();
        return view('collectors.edit',
            [
                'equipments' => $equipments,
                'route' => route('api.collectors.store'),
                'boxTitle'=>'添加采集设备',
                'active' => 'collectors',
            ]
        );
    }


}
