<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hastable('upload_file')){   //判断数据表是否存在
            Schema::create('upload_file', function(Blueprint $table){
                $table->increments('id')->index();  // 自增ID
                $table->tinyInteger('user_id');   //上传用户的ID
                $table->string('file_path',250); //varchar型,存放文件上传路径
                $table->tinyInteger('file_type');    //上传文件的类型
                $table->dateTime('upload_time'); //上传文件时间
            });

        }else{
            Schema::table('upload_file',function($table){
//                $table->tinyInteger('user_id')->comment('上传用户ID')->change();
                $table->string('file_path',250)->comment('存放文件上传路径')->change();
//                $table->tinyInteger('file_type')->comment('上传文件类型')->change();
                $table->dateTime('upload_time')->comment('上传文件时间')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
