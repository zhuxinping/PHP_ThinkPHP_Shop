<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 9:12
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden=['delete_time','update_time','create_time'];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
   /* public function CategoriesProduct(){
        return $this->hasMany('Product','category_id','id');
    }
    public static function getCategoriesWithProductList($id){
        $categoriesProductList=self::with(['img','CategoriesProduct'])->find($id);
        return $categoriesProductList;
    }*/
}