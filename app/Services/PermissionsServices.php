<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/3
 * Time: 下午4:15
 */
namespace App\Services;

use App\Eloquent\CompaniesModel;
use App\Eloquent\ApiModuleModel;
use Illuminate\Pagination\LengthAwarePaginator;

class PermissionsServices extends ServicesAdapte
{
    public function getUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_PERMISSION_LIST;
    }

    public function getSaveUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_PERMISSION_SAVE;
    }

    public function getDeleteUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_PERMISSION_DELETE;
    }

    public function getRetrieveByIdUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_PERMISSION_RETRIEVEBYID;
    }

    public function getAllPermissionsUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_PERMISSION_ALLPERMISSIONS;
    }
}