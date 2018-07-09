<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/6
 * Time: 上午9:36
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AlgorithmsServices;
use App\Http\Controllers\Controller;

class AlgorithmsController extends Controller{

    public function __construct()
    {
        $this->algorithmsServices = new AlgorithmsServices();
    }

    public function index(){
        $algorithms = config('algorithm');
        return view('algorithms.list',
            [
                'route' => route('api.algorithm.getOptionHtml'),
                'boxTitle'=>'算法数据展示',
                'active' => 'algorithms',
                'algorithms'=>$algorithms,
            ]
        );
    }

    public function getData(Request $request){
        $url = $request->get('url');
        $data = $this->algorithmsServices->getApiInfo($this->algorithmsServices->getUrl().'/'.$url,[]);
        return  $data;
    }



}