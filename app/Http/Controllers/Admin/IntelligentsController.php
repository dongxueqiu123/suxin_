<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/17
 * Time: 上午9:27
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class IntelligentsController extends Controller {

    public function __construct()
    {
    }

    public function index(){
        return view('intelligent.index',[
            'active'=>'intelligents'
        ]);
    }
}