<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/13
 * Time: 9:05
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    //  HTTP 状态码 404,200
    public $code = 400;

    //  错误具体信息
    public $msg = "微信服务器接口调用失败";

    //  自定义的错误码
    public $errorCode = 10000;
}