<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 17:56
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code=4040;
    public $msg='用户不存在';
    public $errorCode=60000;
}