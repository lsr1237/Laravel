<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\12\20 0020
 * Time: 17:18
 */
namespace App\Http\Upload;

use Illuminate\Http\Request;

//上传类
class Upload
{
    /**
     *  上传图片
     */
    public function upload_img($base64_img){
        //保存地址
        //文件名
        /**
         * 过滤数据(中间件)
         * 校验文件类型
         * 校验文件大小
         */
        //判断保存路径是否存在
        echo '这是img';
    }

    /**
     * 上传视频
     */
    public function upload_video(){

    }
}