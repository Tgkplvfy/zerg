<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/6
 * Time: 21:27
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    //  HTTP 状态码 404,200
    public $code = 400;

    //  错误具体信息
    public $msg = "参数错误";

    //  自定义的错误码
    public $errorCode = 10000;


}