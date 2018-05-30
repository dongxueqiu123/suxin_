<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 上午10:23
 */
namespace App\Services;

use GuzzleHttp\Client;

class ServicesAdapte implements ServicesInterface{
    const  LIMITATION = 'limitation';
    const  PAGINATION = 'pagination';


    public function getList(){

    }

    public function save(array $modelData){

    }

    public function get($id){

    }

    public function destroy($id){

    }

    public function getClient(string $url,int $pageSize = 0, int $pagination = 1 ,array $parameters = [], array $excepts = []){
        $http = new Client();
        $array = []; $urlParameter = '';
        foreach ($parameters as $name=>$parameter)
        {
            foreach ($excepts as $except){
                 if($except == $name){
                     continue 2;
                 }
            }
            $array[] = $name.'='.$parameter;
        }

        $pageUrl = '?'.self::LIMITATION.'='.$pageSize.'&'.self::PAGINATION.'='.$pagination.'&';
        foreach ($excepts as $except){
            if($except == self::LIMITATION && $except == self::PAGINATION){
                $pageUrl ='?';
            }
        }
        (!empty($array)) && $urlParameter = $pageUrl.implode('&',$array);
        $response = $http->get($url.$urlParameter);
        $body = json_decode((string)$response->getBody(), true);
        return $body;
    }

}