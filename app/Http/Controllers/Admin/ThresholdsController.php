<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 2018/3/30
 * Time: 10:07
 */
namespace App\Http\Controllers\Admin;

use App\Services\ThresholdsServices;
use App\Http\Controllers\Controller;

class ThresholdsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->thresholdsServices = new ThresholdsServices();
        $this->middleware('auth.user');
    }

    public function index()
    {

        $thresholds = $this->thresholdsServices->getAll();
        foreach ($thresholds as $threshold){
            $threshold->pattern  = $this->thresholdsServices->getConstant($threshold,'pattern');
            $threshold->category = $this->thresholdsServices->getConstant($threshold,'category');
            $threshold->grade    = $this->thresholdsServices->getConstant($threshold,'grade');
        }
        return view('thresholds.list',
            [
                'thresholds' => $thresholds,
                'boxTitle'=>'告警阈值列表',
                'active' => 'thresholds'
            ]
        );
    }

    public function edit($id){
        $threshold= $this->thresholdsServices->get($id);
        $patterns   = $this->thresholdsServices->getConstant(null,'pattern');
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        return view('thresholds.edit',
            [
                'route' => '/api/admin/thresholds/edit/'.$id,
                'boxTitle'=> '修改告警阈值',
                'active' => 'thresholds',
                'threshold' => $threshold,
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
            ]
        );
    }

    public function store(){
        $patterns   = $this->thresholdsServices->getConstant(null,'pattern');
        $categories = $this->thresholdsServices->getConstant(null,'category');
        $grades     = $this->thresholdsServices->getConstant(null,'grade');
        return view('thresholds.edit',
            [
                'route' => route('api.thresholds.store'),
                'boxTitle'=>'添加告警阈值',
                'active' => 'thresholds',
                'patterns' => $patterns,
                'categories' => $categories,
                'grades' => $grades,
            ]
        );
    }


}
