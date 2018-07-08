<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 17:05
 */

namespace app\api\model;


class Banner extends BaseModel
{   protected $hidden=['update_time','delete_time'];
    //业务代码都写在Model层
   // protected $table='category';
    //关联模型
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public static function getBannerByID($id){
        $banner=self::with(['items','items.img'])->find($id);
        return $banner;
        //TODO:根据banner  ID号获取banner信息
//        try{
//            1/0;
//        }
//        catch (Exception $ex){
//            //TODO:可以记录日志
//            throw $ex;
//        };
//        return 'this  is a banner info!'.$id;
        //return null;
        //业务逻辑:根据传来的id查询到数据返回给客户端
//           $result = Db::query('select * from banner_item where banner_id=?',[$id]);
//          return $result;
       // $result=Db::table('banner_item')->where('banner_id','=',$id)->find();//返回一个query对象
        //$result=Db::table('banner_item')->where('banner_id','=',$id)->find();//返回一个数据
        //query链式调用
        //where('字段名','表达式','查询条件');
        //表达式 数组法  闭包
//        $result=Db::table('banner_item')->where('banner_id','=',$id)
//            ->select();//返回多个数据
//        $result=Db::table('banner_item')
//            ->fetchSql()->where(function ($query) use ($id){
//                $query->where('banner_id','=',$id);
//            })->select();
      /*  $result=Db::table('banner_item')
            ->where(function ($query) use ($id){
                $query->where('banner_id','=',$id);
            })->select();*/
       // updtate更新
        //delete 删除
       // insert 插入
  //ORM -> Obeject Relation Mapping 对象关系映射
//模型

        //return $result;
    }
}