<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/5
 * Time: 10:03
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isPositiveInteger',
        'num'=>'in:1,2,3'
    ];

    /*
     * 自定义验证正整数的验证方法
     * */
    protected function isPositiveInteger($value,$rule='',$data='',$field=''){
        if(is_numeric($value) &&is_int($value+0)&&($value+0)>0){
            return true;
        }else{
            return $field.'必须是正整数';
        }
    }
}