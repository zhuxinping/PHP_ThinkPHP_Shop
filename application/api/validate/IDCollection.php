<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 15:20
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule=[
        'ids'=>'require|checkIDs'
    ];
    protected $message=[
        'ids'=>'ids必须是以逗号为分隔的多个正整数'
    ];
    protected function checkIDs($value){
        $values=explode(',',$value);
        if(empty($values)){
            return false;
        }
        foreach ($values as $id){
          if(!$this->isPositiveInteger($id)){
              return false;
          }
        }
        return true;
    }
}