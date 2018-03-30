<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 上午10:27
 */
namespace App\Services;

interface ServicesInterface{
     public function getList();

     public function save(array $modelData);

     public function get($id);

     public function destroy($id);
}