<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\EntrustPermission;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Permission extends EntrustPermission
{
    use EntrustUserTrait;
    protected $table = 'permissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'name', 'display_name', 'description', 'module_types'
    ];

}

