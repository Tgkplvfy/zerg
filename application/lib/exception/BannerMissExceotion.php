<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/5
 * Time: 15:41
 */

namespace app\lib\exception;


class BannerMissExceotion extends BaseException
{
    public $code = 404;
    public $msg = '请求banner不存在';
    public $errorCode = '40000';
}