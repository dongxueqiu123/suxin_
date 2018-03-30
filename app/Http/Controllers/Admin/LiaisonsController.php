<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午4:41
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LiaisonsServices;
use App\Services\ThresholdsServices;

class LiaisonsController extends Controller {

    public function __construct()
    {
        $this->liaisonsServices   = new LiaisonsServices();
        $this->thresholdsServices = new ThresholdsServices();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $liaisons = $this->liaisonsServices->getAll();
        foreach ($liaisons as $liaison){
            $liaison->pattern  = $this->thresholdsServices->getConstant($liaison,'pattern');
        }
        return view('liaisons.list',
            [
                'liaisons' => $liaisons,
                'boxTitle'=>'告警联系人列表',
                'active' => 'liaisons'
            ]
        );
    }

    public function edit($id){
        $liaison = $this->liaisonsServices->get($id);
        $patterns = $this->thresholdsServices->getConstant(null,'pattern');
        return view('liaisons.edit',
            [
                'route' => '/api/admin/liaisons/edit/'.$id,
                'boxTitle'=> '修改告警联系人',
                'active' => 'liaisons',
                'liaison' => $liaison,
                'patterns' => $patterns,
            ]
        );
    }

    public function store(){
        $patterns = $this->thresholdsServices->getConstant(null,'pattern');
        return view('liaisons.edit',
            [
                'route' => route('api.liaisons.store'),
                'boxTitle'=>'添加告警联系人',
                'active' => 'liaisons',
                'patterns' => $patterns,
            ]
        );
    }
}