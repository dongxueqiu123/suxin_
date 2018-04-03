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

    public function scopeNothing($query){return $query;}

    public function scopePattern($query,$pattern){
        $query->where('pattern' ,'=' ,$pattern);
    }

    public function company(){
        return $this->belongsTo('App\Eloquent\CompaniesModel','pattern_id','id');
    }

    public function equipment(){
        return $this->belongsTo('App\Eloquent\EquipmentsModel','pattern_id','id');
    }

    public function collector(){
        return $this->belongsTo('App\Eloquent\CollectorsModel','pattern_id','id');
    }
}