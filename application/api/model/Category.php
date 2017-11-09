<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/9
 * Time: 9:49
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];

    public function Img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }


}