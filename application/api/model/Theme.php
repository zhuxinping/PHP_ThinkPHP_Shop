<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 14:46
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden=['delete_time','update_time'];
    public function topicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }
    public function products(){
        //多对多的关系 需要第三张表关联 ('关联模型','关联表表名','外键','主键')
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }
    public static  function getThemeWithProducts($id){
        $theme=self::with(['products','topicImg','headImg'])->find($id);
        return $theme;
    }
}