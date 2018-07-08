<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 14:35
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code=401;
    public $msg='Token已经过期或者无效Token';
    public $errorCode=10001;
}