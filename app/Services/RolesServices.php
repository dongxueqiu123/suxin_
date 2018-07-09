<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/3
 * Time: 下午2:25
 */
namespace App\Services;

use App\Eloquent\CompaniesModel;
use App\Eloquent\ApiModuleModel;
use Illuminate\Pagination\LengthAwarePaginator;

class RolesServices extends ServicesAdapte
{
    public function getUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ROLE_LIST;
    }

    public function getSaveUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ROLE_SAVE;
    }

    public function getDeleteUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ROLE_DELETE;
    }

    public function getRetrieveByIdUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ROLE_RETRIEVEBYID;
    }

}