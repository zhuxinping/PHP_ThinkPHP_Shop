<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //
    protected function prefixImgUrl($value,$data){
        //读取器地址拼接
        $finalUrl=$value;
        if($data['from']==1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
