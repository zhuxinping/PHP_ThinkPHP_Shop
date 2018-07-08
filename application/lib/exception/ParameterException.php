<?php
/**
 * Created by PhpStorm.
 * User: zxp
 * Date: 2018/3/30
 * Time: 22:08
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code=400;
    public $msg='参数错误';
    public $errorCode=10000;
}