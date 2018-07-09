<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/2
 * Time: 下午4:46
 */
namespace App\Services;

use App\Eloquent\CompaniesModel;
use App\Eloquent\ApiModuleModel;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersServices extends ServicesAdapte
{
    public function getUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_USER_LIST;
    }

    public function getSaveUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_USER_SAVE;
    }

    public function getDeleteUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_USER_DELETE;
    }

    public function getRetrieveByIdUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_USER_RETRIEVEBYID;
    }

    public function getRetrieveAllAdministratorsUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_USER_RETRIEVEALLADMINISTRATORS;
    }
}