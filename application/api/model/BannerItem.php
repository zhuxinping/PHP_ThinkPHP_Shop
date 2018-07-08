<?php

namespace app\api\model;

class BannerItem extends BaseModel
{
    protected $hidden=['delete_time','update_time','img_id','id','banner_id'];
    //protected $visible=['id'];
    //
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}
