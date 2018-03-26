<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompaniesModel extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','abbreviation','userId','created_at','updated_at'
    ];


    public function scopeId($query,$id){
        $query->where('id','=',$id);
    }
}

