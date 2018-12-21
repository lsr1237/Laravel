<?php
/**
 * 配置文件
 * 配置文件上传的限制
 * 1、大小
 * 2、格式
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\12\21 0021
 * Time: 13:06
 */
return [
    'file'=>[
        'size'=>'',
        'ext'=>['txt','mp4']
    ],
    'img'=>[
        'size'=>'',
        'ext'=>['img','png','jpeg']
    ],
    'video'=>[
        'size'=>'',
        'ext'=>'mp4',
    ],
    'save_path'=>[
        'file'=>'file_uploads',
        'img'=>'img_uploads',
        'video'=>'vodio_uploads',
    ],
];