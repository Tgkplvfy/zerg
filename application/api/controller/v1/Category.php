<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/9
 * Time: 9:48
 */

namespace app\api\controller\v1;


use app\lib\exception\CategoryException;
use think\Controller;
use app\api\model\Category as categoryModel;

class Category extends Controller
{
    public function getAllCategories(){
        $categories = categoryModel::with('Img')->select();
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }
}