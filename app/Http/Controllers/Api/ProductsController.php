<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/3
 * Time: 上午9:33
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductsServices;
use Illuminate\Http\Request;
use App\Functions\imageUpload;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->productsServices = new ProductsServices();
        $this->imageUpload = new imageUpload('','');
        $this->middleware('auth.user');
    }

    public function edit($id,Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'priceOriginal' => 'required',
            'isAlive' => 'required',
            'unit' => 'required',
            'description' => 'required',
        ]);

        $input = $request->only(['name', 'price', 'priceOriginal', 'isAlive', 'unit', 'description','finalImagesStr']);
        $input['id'] = $id;
        $finalImages =  explode('|',$input['finalImagesStr']);
        $finalImageUrl = [];
        foreach ($finalImages as $key=>$finalImage)
        {
            //dump($finalImage,strpos($finalImage,'base64'));

            $finalImageUrl[] = strpos($finalImage,'base64')?(new imageUpload('',''))->stream2Image($finalImage):$finalImage;
        }

        $input['finalImages'] =  (!empty($finalImageUrl))?implode('|',$finalImageUrl):$finalImageUrl;
        $input['image'] = reset($finalImageUrl);
        if($state = $this->productsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('products')
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'priceOriginal' => 'required',
            'isAlive' => 'required',
            'unit' => 'required',
            'description' => 'required',
        ]);
        $input = $request->only(['name', 'price', 'priceOriginal', 'isAlive', 'unit', 'description','finalImagesStr']);
        $finalImages =  explode('|',$input['finalImagesStr']);
        $finalImageUrl = [];
        foreach ($finalImages as $key=>$finalImage)
        {
            !empty($finalImage) && $finalImageUrl[] = (new imageUpload('',''))->stream2Image($finalImage);
        }
        $input['finalImages'] = (!empty($finalImageUrl))?implode('|',$finalImageUrl):$finalImageUrl;
        $input['image'] = reset($finalImageUrl);
        if($state = $this->productsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('products')
            ]);
        }
    }

    public function delete($id,Request $request)
    {
        $input['id'] = $id;
        $input['deleteTime'] = date('Y-m-d H:i:s',time());
        if($state = $this->productsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('products')
            ]);
        }
    }

    public function storeImage(Request $request){
        $imgFile =  $request->file('imgFile');
        $this->imageUpload->saveImage($imgFile);
    }

}