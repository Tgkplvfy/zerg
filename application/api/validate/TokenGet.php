<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/12
 * Time: 20:37
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code'=>'require|isNotEmpty'
    ];

    protected $message = [
        'code'=>'没有code还想拿token？做梦哦'
    ];

}