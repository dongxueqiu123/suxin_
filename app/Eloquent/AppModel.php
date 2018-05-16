<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/13
 * Time: 下午4:07
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AppModel extends Model{
    public function scopeNothing($query){return $query;}

    public function scopeDeleteTime($query){$query->where('delete_time' ,'=' ,NUll);}

    public function scopeLatest($query){$query->orderBy('id', 'desc');}

    public function scopeSort($query){$query->orderBy('sort', 'desc');}
}