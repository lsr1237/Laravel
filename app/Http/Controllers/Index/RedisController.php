<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\12\19 0019
 * Time: 19:27
 */

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;


class RedisController extends Controller
{
    public  function test_redis(){
        Redis::set('name', 'guwenjie');
        $values = Redis::get('name');
        p($values);
    }
}