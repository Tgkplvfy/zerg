<?php
/**
 * Created by PhpStorm.
 * User: 神秘者007
 * Date: 2017/11/9
 * Time: 9:19
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductException;
use think\Controller;
use app\api\model\Product as productModel;

class Product extends Controller
{

    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $product = productModel::getMostRecent($count);
        if($product->isEmpty()){
            throw new ProductException();
        }
        $product = $product->hidden(['summary']);
        return $product;
    }

    public function getAllInCategory($id){
        (new IDMustBePositiveInt())->goCheck();
        $products = productModel::getProductByCategoryID($id);
        if($products->isEmpty()){
            throw new ProductException();
        }
        return $products;
    }
}