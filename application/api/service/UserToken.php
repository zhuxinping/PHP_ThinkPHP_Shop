<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 12:31
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;
    function __construct($code)
    {//构造函数
        $this->code=$code;
        $this->wxAppId=config('wx.app_id');
        $this->wxAppSecret=config('wx.app_secret');
        $this->wxLoginUrl=sprintf(config('wx.login_url'),
            $this->wxAppId,$this->wxAppSecret,$this->code);
    }

    public function get(){
       $result = curl_get($this->wxLoginUrl);
       $wxResult=json_decode($result,true);
       if(empty($wxResult)){
           throw  new Exception('获取session_key及openID时异常，微信内部错误');
       }else{
           $loginFail=array_key_exists('errcode',$wxResult);
           if($loginFail){
                $this->processLoginError($wxResult);
           }else{
               return $this->grantToken($wxResult);//return出token出去
           }
       }
    }
    private function grantToken($wxResult){
        //拿到openid
        //数据库里面看一下这个openid是不是已经存在
        //如果存在则不处理，如果不存在那么新增一条记录
        //生成令牌，准备缓存数据 写入缓存
        //把令牌返回到客户端去
        //key:令牌
        //value:wxResult,uid,scope
        $openid=$wxResult['openid'];//拿到openid去数据库比对看是否存在
        $user=UserModel::getByopenID($openid);
        if($user){
            $uid=$user->id;
        }else{
           $uid=$this->newUser($openid);
        }
        $cacheValue=$this->prepareCacheValue($wxResult,$uid);
        $token=$this->saveToCache($cacheValue);
        return $token;
    }
    private function saveToCache($cacheValue){
        $key=self::generateToken();
        $value=json_encode($cacheValue);
        $expire_in=config('setting.token_expire_in');
        $request=cache($key,$value,$expire_in);//设置缓存
        if(!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errorCode'=>10005
            ]);
        }
        return $key;
    }
    private function prepareCacheValue($wxResult,$uid){
        $cacheValue=$wxResult;
        $cacheValue['uid']=$uid;//uid加进去
        //scope=16代表app用户的权限数值
        $cacheValue['scope']=ScopeEnum::User;//scope加进去数据越大表示可以访问的接口越多
        //scope=32代表cms(管理员)用户的权限数值
       // $cacheValue['scope']=32;//scope加进去数据越大表示可以访问的接口越多
        return $cacheValue;
    }
    private function newUser($openid){
        $user=UserModel::create([
            'openid'=>$openid
        ]);
        return $user->id;
    }
    private function processLoginError($wxResult){
       throw new WeChatException([
           'msg'=>$wxResult['errmsg'],
           'errorCode'=>$wxResult['errcode']
       ]);
    }
}