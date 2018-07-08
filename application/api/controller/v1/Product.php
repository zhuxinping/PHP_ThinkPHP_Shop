<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 17:28
 */

namespace app\api\controller\v1;
use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductException;

//根据产品传入数量获取最新产品
class Product
{
    //$count默认15  有的话就是客户端传入
    function getRecent($count=15){
        (new Count())->goCheck();
        $products=ProductModel::getMostRecent($count);
       // $collection=collection($products);
        //临时隐藏不需要的字段
        if($products->isEmpty()){
            throw  new ProductException();
        }
        $products=$products->hidden(['summary']);
        return $products;
    }
    public function getAllInCategory($id){
        (new IDMustBePositiveInt())->goCheck();
        $products=ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products=$products->hidden(['summary']);
        return $products;
    }
    public function getOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $product=ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }
        return $product;
    }
    public function deleteOne($id){

    }
}