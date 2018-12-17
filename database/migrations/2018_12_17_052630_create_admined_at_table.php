<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminedAtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hastable('admin_at')){
            //创建数据表
            Schema::create('admin_at',function (Blueprint $table){
                $table->string('id')->index();
                $table->string('name');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->timestamp('deleted_at')->nullable();
                //
                $table->engine = 'Innidb';      //指定表的存储引擎
                $table->charset = 'utf8';       //指定数据表默认的字符集
                $table->collation = 'utf8_unicode_ci';      //指定数据表默认的排序规则
                $table->temporary();        //创建临时表

                //创建字段常用指令
                $table->increments('id');           //创建递增ID
                $table->bigIncrements('id');        //创建递增ID
                $table->string('name');         //varchar型 （变换长度）
                $table->char('name',523);     //char型数据（固定长度）
                $table->data();
                $table->datatime();
                $table->uuid();     //生成UUID
                //字段修饰
                $table->string()->affter('first');  //该字段放于first字段之后
                $table->string()->autoIncrement();  //将INTEGER字段设置成自动递增的
                $table->string()->charset('utf8');  //设置字符集
                $table->string()->collation('utf8_unicode_ci'); //指定排序规则
                $table->string()->comment('这是一条注释');
                $table->string()->default('定义字段的默认值');

            });
            //重命名数据表
            Schema::rename('原来的名字', '更改成的名字');
            //删除表
            Schema::drop('数据表名');
            Schema::dropIfExists('数据表名');
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
