<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 9:11
 */

namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;
use app\api\validate\IDMustBePositiveInt;
class Category
{
    public function getAllCategories(){
        $categories=CategoryModel::all([],'img');
        //$categories=CategoryModel::with(['img'])->select();
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }
   /* public function getCategoriesList($id){
       (new IDMustBePositiveInt())->goCheck();
        $categoriesList=CategoryModel::getCategoriesWithProductList($id);
        if(!$categoriesList){
            throw new CategoryException();
        }
        return $categoriesList;
    }*/
}