<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function index()
    {
        return view('admin.highchart');
    }

    public function highcharts(){
        return view('admin.index');
    }

    public function permission(){
        return view('permission');
    }

    public function test11(){
        return view('test',
            [
                'boxTitle'=>'测试11',
                'active' => 'test11'
            ]
        );
    }

    public function test12(){
        return view('test',
            [
                'boxTitle'=>'测试12',
                'active' => 'test12'
            ]
        );
    }

    public function test2(){
        return view('test',
            [
                'boxTitle'=>'测试2',
                'active' => 'test2'
            ]
        );
    }
}
