<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/13
 * Time: 17:15
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = [
        'product_id','id','delete_time'
    ];
}