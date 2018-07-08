<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 11:54
 */

namespace app\api\model;


class User extends BaseModel
{
    public static function getByopenID($openid){
        $user=self::where('openid','=',$openid)->find();
        return $user;
    }
    public function address(){//没有外键的一方使用hasOne
        return $this->hasOne('UserAddress','user_id','id');
    }
}