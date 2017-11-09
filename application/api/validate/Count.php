<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/9
 * Time: 9:22
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count'=>'isPositiveInteger|between:1,15'
    ];
}