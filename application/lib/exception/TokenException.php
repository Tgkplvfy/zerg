<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/13
 * Time: 15:03
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    //  HTTP 状态码 404,200
    public $code = 401;

    //  错误具体信息
    public $msg = "Token已过期或无效Token";

    //  自定义的错误码
    public $errorCode = 10001;
}