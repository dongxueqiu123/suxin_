<?php

namespace App\Http\Middleware;

use Closure;
use App\Eloquent\ApiModuleModel;
use App\Services\ServicesAdapte;
use App\Services\CartsServices;

class AlarmCount {



    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $servicesAdapte = new ServicesAdapte();
        $queryArray['firmId'] = \Auth()->user()->company->id??'1';
        //机械设备总数
        $body  = $servicesAdapte->getInfoClient(env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_COUNTALARM,$queryArray);
        $count =  empty($body['data']) ?0: $body['data'];
        $request->session()->put('alarmCount', $count);

        $cartsServices =  new CartsServices();
        $count = $cartsServices->getCount();
        $request->session()->put('cartsCount', $count);
        return $next($request);
    }

}