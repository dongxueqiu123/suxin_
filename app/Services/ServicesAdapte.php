<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 上午10:23
 */
namespace App\Services;

use GuzzleHttp\Client;
use App\Eloquent\ThresholdsModel;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getApiList($url,int $pageSize,int $pagination,array $parameters, array $ext = []){
        $responses = $this->getClient($url,$pageSize,$pagination,$parameters);
        $alarms = is_array($responses['data'])?$responses['data']:[];
        $count = isset($responses['count'])?(int) $responses['count']:0;
        foreach ($ext as $name=>$value){
            if($name == 'category'||$name == 'grade'||$name == 'categoryUnit'||$name == 'limit'){
                foreach($alarms as $key=>$alarm){
                    $value && $alarms[$key]['categoryUnit'] = $this->getConstantByArray($alarm,'categoryUnit','category');
                    $value && $alarms[$key]['categoryName'] = $this->getConstantByArray($alarm,'category');
                    $value && $alarms[$key]['gradeName'] = $this->getConstantByArray($alarm,'grade');
                    $value && $alarms[$key]['limitName'] = $this->getConstantByArray($alarm,'limit','pattern');
                }
            }
        }
        $responses['data'] = $this->pagination($alarms,$count, $pageSize, $pagination);
        return $responses;
    }

    private function pagination($collectors,$count,$pageSize,$pagination){
        return new LengthAwarePaginator($collectors,$count,$pageSize,$pagination,['path'=>'']);
    }

    private function getClient(string $url,int $pageSize = 0, int $pagination = 1 ,array $parameters = []){

        $array = []; $urlParameter = '';
        foreach ($parameters as $name=>$parameter)
        {
/*            foreach ($excepts as $except){
                 if($except == $name){
                     continue 2;
                 }
            }*/
            $array[] = $name.'='.$parameter;
        }

        $pageUrl = $pageSize == 0?'?':'?'.self::LIMITATION.'='.$pageSize.'&'.self::PAGINATION.'='.$pagination;
        $urlParameter = (empty($array)) ? $pageUrl : $pageUrl.'&'.implode('&',$array);
        $body = $this->httpGet($url.$urlParameter);
        return $body;
    }

    public function getApiInfo($url,array $parameters,array $ext = []){
        return $this->getInfoClient($url,$parameters);
    }

    public function getInfoClient(string $url,array $parameters = []){

        $array = [];
        foreach ($parameters as $name=>$parameter)
        {
            $array[] = $name.'='.$parameter;
        }
        $urlParameter = !empty($parameters)?'?'.implode('&',$array):'';
        $body = $this->httpGet($url.$urlParameter);
        return $body;
    }

    private function httpGet($url){
        $http = new Client();

        try{
            $response = $http->get($url);
            $body = json_decode((string)$response->getBody(), true);
        }catch (\Exception $e){
            $body = ['code' => 999,'info' => '请求超时','data' => '','count'=> 0];
        }
        return $body;
    }

    public function postClient(string $url,array $parameters = []){
        $jsonParameters = json_encode($parameters);

        $http = new Client();
        try{
            $result = $http->request('POST',$url,[
                'headers' => [
                    'Content-Type' => 'application/json;charset=utf-8',
                ],
                'body'   => $jsonParameters
            ]);

            if($result->getBody()->getSize()){
                $contents = $result->getBody()->getContents();
                $body = json_decode($contents,true);
            }else{
                $body = ['code' => 998,'info' => '其他错误','data' => '','count'=> 0];;
            }

        }catch (\Exception $e){
            $body = ['code' => 999,'info' => '请求超时','data' => '','count'=> 0];
        }

        return $body;
    }

    private function getConstantByArray(array $array,$name,$key = ''){
        $thresholds = new ThresholdsModel();
        $key = empty($key)?$name:$key;
        $id = empty($array)?$array:($array[$key]??null);
        $name ='get'.($name);
        //dump($array,$id,$name);
        return  $thresholds->$name($id);
    }

}