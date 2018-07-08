<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 17:57
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{//重写公共成员属性
    public $code=404;
    public $msg='请求Banner不存在';
    public $errorCode=40000;
}