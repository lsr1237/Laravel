<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    public function initialize(){
        parent::initialize();
    }
    public function __construct(){

    }
    /**
     * 获取密码
     */
    public function  get_Password($name){
        $data =  $this->select('password')->where('name',$name)->get();
        return $data;
    }
}
