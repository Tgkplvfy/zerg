<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/8
 * Time: 16:42
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden = [
        'delete_time', 'update_time', 'topic_img_id', 'head_img_id',
    ];

    //  关联img表
    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    /*
     * 关联product,多对多关系
     * */
    public function products()
    {
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }

    public static function getThemeWithProducts($id){
        $theme = self::with('products,topicImg,headImg')->find($id);
        return $theme;
    }
}