<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/3
 * Time: 上午10:47
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductsDetailsModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'product_details';

    protected $fillable = [
        'id','unit','description'
    ];


}