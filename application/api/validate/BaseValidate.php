<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/5
 * Time: 10:46
 */

namespace app\api\validate;


use app\lib\exception\BannerMissExceotion;
use app\lib\exception\BaseException;
use app\lib\exception\ParameterException;
use think\image\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        //  获取http传入的参数
        //  对这些参数做校验
        $request = Request::instance();
        $params = $request->param();
                        //  批量验证
        $result = $this->batch()->check($params);
        if(!$result){
            //  面向对象思维
            $exception = new ParameterException([
                'msg'=>$this->error,
                'code'=>400,
                'errorCode'=>10002
            ]);
         /*   $error->msg = $this->error;  //  这个$this->error错误信息是从Validate的错误信息
            $error->code = 100002;*/
            throw $exception;
        }else{
            return true;
        }
    }

    /*
     * 自定义验证正整数的验证方法
     * */
    protected function isPositiveInteger($value,$rule='',$data='',$field=''){
        if(is_numeric($value) &&is_int($value+0)&&($value+0)>0){
            return true;
        }else{
            return false;
           /* return $field.'必须是正整数';*/
        }
    }

    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }
}