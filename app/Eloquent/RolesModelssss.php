<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class RolesModel extends EntrustRole
{
    use EntrustUserTrait;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','display_name','description'
    ];

}

