<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 14:23
 */

namespace app\api\controller\v2;
class Banner
{
    /*
     * 获取指定的id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     * **/
    public function getBanner($id){
        return 'This is a V3 Version';
    }

}

