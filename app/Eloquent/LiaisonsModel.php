<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午4:38
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LiaisonsModel extends Model{

    public $timestamps = false;
    protected $table = 'liaison';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','pattern','pattern_id','mobile','email','operator_id'
    ];
}