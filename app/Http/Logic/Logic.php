<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\12\19 0019
 * Time: 9:56
 */

namespace App\Http\Logic;


class Logic
{
    //定义一个缓存类型
    Public $type = null;

    public function __construct($type){
        $allowType = ['redis','memcache','file'];
        if(!in_array($type, $allowType)){
            throw new \Exception("can't find driver");
        }
        $this->type = $type;
    }

    public function log($str){
        echo '当前使用的是'.$this->type.'缓存，缓存数据为：'.$str;
    }
}