<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GatewayClient\Gateway;
use Illuminate\Support\Facades\Redis;

class ClientController extends Controller
{
    private $registerAddress = '127.0.0.1:1238';

    public function __construct()
    {
        Gateway::$registerAddress = $this->registerAddress;
    }
    /**
     * 将uid与client_id 绑定
     * @param Request $request
     * @return string
     */
    public function bind_client_id(Request $request)
    {
        if($request->isMethod('post')){
            $client_id = $request->input('client_id');
            $name = session('name');
            // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
//            Gateway::$registerAddress = '127.0.0.1:1238';
            Gateway::bindUid($client_id,$name);
            //将在线人数存放在在线集合
            Redis::sadd('online_set',$name);
            $count = Redis::scard('online_set');
            $number = Redis::smembers('online_set');
            $msg = [
                'code'=>1,
                'client_id'=>$client_id,
                'name'=>$name,
                'count'=>$count,
                'number'=>$number
            ];
            return json_encode($msg);
        }
    }

    /**
     * 当client_id 断开连接时
     * 将name和client_id解绑
     */
    public function unbind_client_id(Request $request)
    {
        if($request->isMethod('post'))
        {
            $client_id = $request->input('client_id');
            $name = session('name');
            //解除name绑定
            Gateway::unbindUid($client_id,$name);
            //将name从在线集合中去除
            Redis::srem('online_set',$name);
            $count = Redis::scard('online_set');
            $number = Redis::smembers('online_set');
            $msg = [
                'code'=>1,
                'client_id'=>$client_id,
                'name'=>$name,
                'count'=>$count,
                'number'=>$number
            ];
            return json_encode($msg);
        }

    }
}
