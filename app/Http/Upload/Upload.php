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
     *  上传文件
     */
    public function upload($file){
        //保存地址
        //文件名
        /**
         * 过滤数据(中间件)
         * 校验文件类型
         * 校验文件大小
         */
        //判断保存路径是否存在
        //获取文件相关信息
        $originalName = $file->getClientOriginalName();   // 文件原名
        $ext = $file->getClientOriginalExtension();     //文件扩展名
        $realPath = $file->getRealPath();       //临时文件的绝对路径
        $type = $file->getClientMimeType();

        //生成文件名
        $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
        //保存文件
        $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
    }

}