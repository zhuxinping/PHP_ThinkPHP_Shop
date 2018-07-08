<?php
/**
 * Created by PhpStorm.
 * User: zxp
 * Date: 2018/4/9
 * Time: 21:33
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code=403;
    public $msg='权限不够';
    public $errorCode=10001;
}