<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/13
 * Time: 17:13
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = [
        'img_id','delete_time','product_id'
    ];

    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }
}