<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 14:18
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken(){
        //32个字符组成一个随机字符串
        $randChars=getRandChar(32);
        //我们用三组的字符串进行md5加密
        $timestamp=$_SERVER['REQUEST_TIME_FLOAT'];
        //salt
        $salt=config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }
    public static function getCurrentTokenVar($key){
        $token=Request::instance()->header('token');
        $vars=Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }else{
            if(!is_array($vars)){
                $vars=json_decode($vars,true);
            }
           if(array_key_exists($key,$vars)){
                return $vars[$key];
           }else{
               throw new Exception('尝试获取的token变量并不存在');
           }
        }
    }
    public static function getCurrentUid(){
        //token
        $uid=self::getCurrentTokenVar('uid');
        return $uid;
    }
}