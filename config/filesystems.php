<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        //新建一个新的目录来存储上传的文件
        'file_uploads'=>[
            'driver'=>'local',
            //文件上传到storage_path('app/uploads'),
            'root'=>storage_path('app/uploads/file'),
            //文件上传到public/uploads目录 如果要使浏览器能够直接访问 设置到Public 目录
            // 'root'=>public_path('uploads);
        ],
        'img_uploads'=>[
            'driver'=>'local',
            //文件上传到storage_path('app/uploads'),
            'root'=>storage_path('app/uploads/img'),
            //文件上传到public/uploads目录 如果要使浏览器能够直接访问 设置到Public 目录
            // 'root'=>public_path('uploads);
        ],
        'video_uploads'=>[
            'driver'=>'local',
            //文件上传到storage_path('app/uploads'),
            'root'=>storage_path('app/uploads/video'),
            //文件上传到public/uploads目录 如果要使浏览器能够直接访问 设置到Public 目录
            // 'root'=>public_path('uploads);
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
