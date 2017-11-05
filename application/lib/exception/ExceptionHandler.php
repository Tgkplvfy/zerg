<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/5
 * Time: 15:35
 */

namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    //  需要返回客户端当前请求的URL路径

    //  重写了handle类的render方法
    public function render(Exception $e)
    {
        //  在render方法要处理两种情况
        // 1.是处理用户行文导致的异常
        // 2.服务器自身的异常，需要记录日志
        //  判断是否是继承的BaseException异常类来区分是哪种情况
        if($e instanceof BaseException){
            // 1.是处理用户行文导致的异常
            //  自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            // 2.服务器自身的异常，需要记录日志
            $this->code=500;
            $this->msg='服务器内部错误';
            $this->errorCode = 999;

        }
        //  定义返回客户端的结果,resful格式
        $request = Request::instance();
        $result = [
            'msg'=>$this->msg,
            'errorcode'=>$this->errorCode,
            'request_url'=>$request->url()
        ];
        return json($result,$this->code);
    }
}