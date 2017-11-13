<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/12
 * Time: 20:51
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as userModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    /*
     * 构造函数拼接api调用地址
     * */
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl); //  http请求的调用结果
        $wxResult = json_decode($result,true);

        if(empty($wxResult)){
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);  //  判断errcode是否存在,经验性判断,如果错误的话，返回errcode码
            if($loginFail){
                //  调用失败
                $this->processLoginError($wxResult);
            }else{
                //  调用成功
                return $this->grantToken($wxResult);
            }
        }
    }

    /*
     * 授权成功，得到Token
     * */
    private function grantToken($wxResult){
        //  拿到openID
        //  数据库里看一下，这个openid是不是已存在
        //  如果存在，则不处理，如果不存在，那么新增一条user记录
        //  准备缓存数据，写入缓存 ,键值对的缓存
        //  key:令牌,value:wxResult,uid,scope,scope决定用户身份
        //  生成令牌，把令牌返回到客户端去
        $openid = $wxResult['openid'];
        $user = userModel::getByOpenID($openid);
        if($user){
            //  如果存在
            $uid = $user->id;
        }else{
            //  如果不存在
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxResult,$uid);
        $token = $this->saveTocache($cachedValue);
        return $token;
    }

    private function saveTocache($cachedValue){
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = config('setting.token_expire_in');

        //  写入缓存
        $request = cache($key,$value,$expire_in);
        if(!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errorCode'=>10005
            ]);
        }
        return $key;  //  返回$key
    }

    /*
     * 准备缓存数据
     * */
    private function prepareCachedValue($wxResult,$uid){
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }


    /*
     * 新增插入一条user记录
     * */
    private function newUser($openid){
        $user = userModel::create([
            'openid'=>$openid
        ]);
        return $user->id;  //  返回用户id
    }


    /*
     * 把调用接口的错误返回给客户端
     * */
    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode']
        ]);
    }
}