<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/8
 * Time: 19:29
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定商品不存在,请检查主题ID';
    public $errorCode = 20000;
}