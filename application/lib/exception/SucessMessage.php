<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 18:11
 */

namespace app\lib\exception;


class SucessMessage extends BaseException
{
    public $code=201;
    public $msg='ok';
    public $errorCode=0;
}