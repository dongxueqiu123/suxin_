<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/8
 * Time: 下午4:00
 */
namespace App\Eloquent;

class CartsModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'carts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','product_id','user_id','company_id','operate_time','delete_time'
    ];

    public function scopeProductId($query,$productId){
        $query->where('product_id' ,'=' ,$productId);
    }

    public function scopeUserId($query,$userId){
        $query->where('user_id' ,'=' ,$userId);
    }

    public function scopeCompanyId($query,$companyId){
        $query->where('company_id' ,'=' ,$companyId);
    }

    public function product(){
        return $this->hasOne('App\Eloquent\ProductsModel','id','product_id');
    }


}