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

}

