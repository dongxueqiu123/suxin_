<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Eloquent\UsersModel;


class RolePermission
{
    
    public function handle($request, Closure $next)
    {
        $route = Route::currentRouteName();
        $routeNames = explode('.',$route);
        $user = UsersModel::find(Auth::user()->id);
        if((!$user->can($routeNames['0']))&&$user->id!=1){
            return redirect()->to('admin/permission');
        }
        return $next($request);
    }
}
