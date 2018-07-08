<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 17:31
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count'=>'isPositiveInteger|between:1,15'
    ];

}