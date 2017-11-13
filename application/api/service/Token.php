<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/13
 * Time: 14:46
 */

namespace app\api\service;


class Token
{
    public static function generateToken(){
        //  32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        //  用三组字符串，进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME'];
        //  salt 盐
        $salt = config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }
}