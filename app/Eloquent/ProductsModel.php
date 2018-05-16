<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/3
 * Time: 上午10:22
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductsModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','price','price_original','img_thumbs','is_alive','operate_time','delete_time'
    ];

    public function detail()
    {
        return $this->hasOne('App\Eloquent\ProductsDetailsModel','id','id');
    }

}