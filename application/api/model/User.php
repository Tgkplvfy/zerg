<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/12
 * Time: 20:48
 */

namespace app\api\model;


class User extends BaseModel
{
    public static function getByOpenID($openid){
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }
}