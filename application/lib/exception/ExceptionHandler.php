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
use think\Log;
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
            //  当在开发中，返回的错误是给服务端来调式用的，在上线过程，返回的错误信息是给客户端看的
            if(config('app_debug')){
                //  return default error page
                //  还原handle的默认render方法
                return parent::render($e);
            }else{
                $this->code=500;
                $this->msg='服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
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

    private function recordErrorLog(Exception $e){
       //  初始化日志
        Log::init([ //  因为在config.php配置文件关闭默认日志，在里面记录日志的时候需要初始化
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}