<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "Suxin IoT Solutions" : "Suxin IoT Solutions";
        $view_data = [
            "action" => "home",
            "title" => $title
        ];
        return view('home')->with($view_data);
    }

    public function analytics()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "数据分析" : "Analytics";
        $view_data = [
            "action" => "analytics",
            "title" => $title
        ];
        return view('analytics')->with($view_data);
    }

    public function connectivity()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "物联网" : "Connectivity";
        $view_data = [
            "action" => "connectivity",
            "title" => $title
        ];
        return view('connectivity')->with($view_data);
    }

    public function contact_us()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "联系" : "Contact";
        $view_data = [
            "action" => "contact_us",
            "title" => $title
        ];
        return view('contact_us')->with($view_data);
    }

    public function industrial()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "云储存" : "Cloud Storage";
        $view_data = [
            "action" => "cloud",
            "title" => $title
        ];
        return view('industrial')->with($view_data);
    }

    public function sensors()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "传感器" : "Sensors";
        $view_data = [
            "action" => "sensors",
            "title" => $title
        ];
        return view('sensors')->with($view_data);
    }

}
