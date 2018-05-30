<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\ServicesAdapte;

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
        $body  = $servicesAdapte->getClient('http://52.80.145.123:8080/console/alarm/countAlarm','0','1',$queryArray,[$servicesAdapte::LIMITATION,$servicesAdapte::PAGINATION]);
        $count =  empty($body['data']) ?0: $body['data'];
        $request->session()->put('alarmCount', $count);
        return $next($request);
    }

}