<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/3
 * Time: 上午9:35
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductsServices;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->productsServices = new ProductsServices();
    }

    public function index()
    {
        $queryArray['deleteTime'] = NULL;
        $products = $this->productsServices->getList(static::PAGE_SIZE_DEFAULT,$queryArray);
        return view('products.list',
            [
            'products' => $products,
            'boxTitle'=>'商品列表',
            'active' => 'products'
            ]
        );
    }


    public function edit($id)
    {
        $product = $this->productsServices->get($id);
        $product->img_thumbs = $this->productsServices->explodeImages($product['img_thumbs']);
        return view('products.edit',
            [
                'product' => $product,
                'boxTitle'=>'编辑商品',
                'active' => 'products',
                'route' => route('api.products.edit',['id'=>$id]),

            ]
        );
    }

    public function store()
    {
        return view('products.edit',
            [
                'boxTitle'=>'添加商品',
                'active' => 'products',
                'route' => route('api.products.store'),
            ]
        );
    }

    /**
     * 购买列表
     */
    public function buy(){
        $queryArray['deleteTime'] = NULL;
        $products = $this->productsServices->getList('0',$queryArray);
        return view('products.buy',
            [
                'boxTitle'=>'购买商品',
                'cartsRoute' => route('api.carts.store'),
                'ordersRoute' => route('api.orders.store'),
                'products' => $products,
                'active' => 'buyProducts',
            ]
        );
    }

    /**
     * 展示
     */
    public function show($id){
        $product = $this->productsServices->get($id);
        $product->img_thumbs = $this->productsServices->explodeImages($product['img_thumbs']);
        return view('products.show',
            [
                'boxTitle'=>'购买商品',
                'cartsRoute' => route('api.carts.store'),
                'ordersRoute' => route('api.orders.store'),
                'product' => $product,
                'active' => 'buyProducts',
            ]
        );
    }
}