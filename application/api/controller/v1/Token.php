<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/12
 * Time: 20:36
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = '')
    {
       /* (new TokenGet())->goCheck();
        return 1;*/
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token'=>$token
        ];
    }
}