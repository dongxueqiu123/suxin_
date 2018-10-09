<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\UsersModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;
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

    public function ywIndex()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "传感器" : "Sensors";
        $view_data = [
            "action" => "sensors",
            "title" => $title
        ];
        return view('yw.index')->with($view_data);
    }

    public function ywMalfunction()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "传感器" : "Sensors";
        $view_data = [
            "action" => "sensors",
            "title" => $title
        ];
        return view('yw/index1')->with($view_data);
    }

    public function ywAlgorithm()
    {
        $locale = app()->getLocale();
        $title = ($locale === 'ch') ? "传感器" : "Sensors";
        $view_data = [
            "action" => "sensors",
            "title" => $title
        ];
        return view('yw/index2')->with($view_data);
    }



    public function login(Request $request){
        if($this->attemptLogin($request)){
            $result['name']    = \Auth::user()->name;
            $result['email']   = \Auth::user()->email;
            $result['id']      = \Auth::user()->id;
            $result['companyId']      = \Auth::user()->company->id??1;
            $result['companyName']      = \Auth::user()->company->name??'苏芯物联';
            return response()->json([
                'code' => '0',
                'data' => $result
            ]);
        } else{
            return response()->json([
                'code' => '-1',
                'data' => '账号或密码错误'
            ]);
        }
    }
}
