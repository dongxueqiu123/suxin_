<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CollectorsModel extends Model
{
    public $timestamps = false;
    protected $table = 'collector';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','mac','pattern','pattern_id','operator_id'
    ];

    public function scopeNothing($query){return $query;}

    public function scopePattern($query,$pattern){
        $query->where('pattern' ,'=' ,$pattern);
    }

    public function scopePatternId($query,$patternId){
        $query->where('pattern_id' ,'=' ,$patternId);
    }

    public function company(){
        return $this->belongsTo('App\Eloquent\CompaniesModel','pattern_id','id');
    }

    public function equipment(){
        return $this->belongsTo('App\Eloquent\EquipmentsModel','pattern_id','id');
    }
}

