<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 15:44
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

//goCheck的作用是在基类定义一个公共的方法然所有对象都可以使用，通过这个方法获取所有的http传入的参数，然后用对应的验证器进行验证
class BaseValidate extends Validate
{
    public function goCheck(){
        //抽取公共逻辑
        //获取http传入的参数
        //对参数做校验
        $request=Request::instance();
        $params=$request->param();
        //调用子类定义的验证方法
        $result=$this->batch()->check($params);//$this谁调用$this指向谁 比如IMDMustBePositiveInf调用就相当于$validate=new IDMustBePositiveInt();$result=$validate->check($data);
       //这里的check会去调用对应验证器里面的验证方法进行验证
        if(!$result){
            $e=new ParameterException([
                'msg'=>$this->error,
               // 'code'=>400,
                //'errorCode'=>10002
            ]);
            //$e->msg=$this->error;
            //$e->errorCode=10002;
            throw $e;
          // $error=$this->error;//这个是错误信息打印出来的
           //throw new Exception($error);
        }else{
            return true;
        }
    }
    protected function isPositiveInteger($value,$rule='',$data='',$field=''){
        if(is_numeric($value) && is_int($value+0) &&($value+0)>0){
            return true;//验证通过返回true;
        }else{
           // return $field.'必须是正整数';
            return false;
        }
    }
    protected function isNotEmpty($value,$rule='',$data='',$field=''){
        if(empty($value)){
            return false;//验证通过返回true;
        }else{
            // return $field.'必须是正整数';
            return true;
        }
    }
    public function getDataByRule($arrays){
        if(array_key_exists('user_id',$arrays)|array_key_exists('uid',$arrays)){
            throw new ParameterException([
                'msg'=>'参数中包含有非法的参数名user_id或者uid'
            ]);
        }
        $newArray=[];
        foreach ($this->rule as $key=>$value){
            $newArray[$key]=$arrays[$key];
        }
        return $newArray;
    }
    protected function isMobile($value){
        $rule='^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result=preg_match($rule,$value);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}