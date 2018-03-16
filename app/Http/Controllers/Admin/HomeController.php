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
    
}
