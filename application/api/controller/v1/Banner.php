<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 14:23
 */

namespace app\api\controller\v1;
use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissException;

class Banner
{
    /*
     * 获取指定的id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     * **/
    public function getBanner($id){

            //独立验证
       //$data=['id'=>$id];
        ( new IDMustBePositiveInt())->goCheck();//验证是否是正整数
      /* try{
           $banner = BannerModel::getBannerByID($id);
       }catch (Exception $ex){
           $err=[
               'error_code'=>10001,
               'msg'=>$ex->getMessage()
           ];
           return json($err,400);
       }*/
//AOP面向切面编程
       $banner = BannerModel::getBannerByID($id);
      // $banner->hidden(['update_time','delete_time']);
        //$banner->visible(['id','update_time']);
       //$data=$banner->toArray();
      // unset($data['delete_time']);
       //$banner=BannerModel::with(['items','items.img'])->find($id);
       //get find(返回一条模型对象) all select(返回多条模型对象)

        //$banner=new BannerModel();
        //$banner=$banner->get($id);
        if(!$banner){
            throw  new BannerMissException();
            //throw  new Exception('内部错误');
        }
      // $c = config('setting.img_prefix');
        return $banner;

        //return'通过验证!'.$id;
        /*$validate=new Validate([
            'id'=>''
        ]);*/
     /*   $validate=new IDMustBePositiveInt();
        $result=$validate->batch()->check($data);
        if($result){
            echo $result;
        }else{
            echo '出错!';
        }*/
       /* $data=[
            'name'=>'vendor11111',
            'email'=>'vendorqq.com'
        ];
        $validate=new Validate([
            'name'=>'require|max:10',
            'email'=>'email'
        ]);
        $result=$validate->batch()->check($data);
        //var_dump($result);
        var_dump($validate->getError());*/
           //验证器
    }
   /* public function getBannerItem($id){
        ( new IDMustBePositiveInt())->goCheck();//验证是否是正整数
       $bannerItem=BannerItem::all($id);
       if(!$bannerItem){
           throw  new BannerMissException();
       }else{
           return $bannerItem;
       }
    }*/
}

