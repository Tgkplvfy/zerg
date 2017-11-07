<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/5
 * Time: 9:22
 */

namespace app\api\controller\v1;


use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissExceotion;

class Banner
{
    /*
     * 获取制定id的banner信息
     * @id banner的id号
     * @http get
     * @url /banner/:id
     * */
    public function getBanner($id){
        (new IDMustBePositiveInt())->goCheck();
         $banner = BannerModel::get($id);
         if(!$banner){
             throw new BannerMissExceotion();
         }
        return $banner;
    }
}