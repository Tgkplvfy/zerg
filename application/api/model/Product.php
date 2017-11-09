<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/8
 * Time: 16:41
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = [
        'delete_time','update_time','category_id','from','img_id','pivot','create_time'
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count){
        $products = self::limit($count)->order('create_time desc')->select();
        return $products;
    }

    public static function getProductByCategoryID($categoryID){
        $products = self::where('category_id','=',$categoryID)->select();
        return $products;
    }
}