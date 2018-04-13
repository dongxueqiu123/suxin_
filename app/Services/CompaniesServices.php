<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午1:18
 */
namespace App\Services;

use App\Eloquent\CompaniesModel;

class CompaniesServices extends ServicesAdapte{

    public function __construct(){
        $this->init();
    }

    private $companies;
    public function init(){
        $this->companies = new CompaniesModel();
    }

    function getAll(){
        return $this->companies::all();
    }

    public function get($id){
        $company = $this->companies::find($id);
        return $company;
    }

    /**
     * 用户是否属于公司
     * @param $company
     * @param $user
     * @return bool
     */
    public function isUserInCompany(object $company, object $user){
        $inCompany = false;
        $companyId = $user->company->id??'';
        if(($company->id??'') == $companyId || empty($companyId)){
            $inCompany = true;
        }
        return $inCompany;
    }

    /**
     * 是否存在FirmId
     * @param $item
     * @return bool
     */
    public function isHaveFirmId(object $item){
        $haveFirmId = false;
        if($item->firm_id){
            $haveFirmId = true;
        }
        return $haveFirmId;
    }

    /**
     * 是否具有权限
     * @param $id
     */
    public function isHavePermission($id = null){
        $havePermission = false;
        if(empty($id)||$id == 1){
            $havePermission = true;
        }
        return $havePermission;
    }

    /**
     * 过滤无编号和不是该厂用户的数据
     * @param $items
     * @return array
     */
    public function getHaveFirmIdAndInCompany($items, $user){
         $result = [];
         foreach ($items as $item){
             if($item->firm_id && $this->isUserInCompany($item, $user)){
                 $result[] = $item;
             }
         }
         return $result;
    }

}