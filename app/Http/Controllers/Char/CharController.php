<?php

namespace App\Http\Controllers\Char;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GatewayClient\Gateway;
use Illuminate\Support\Facades\Redis;

/**
 * Class CharController
 * 即时聊天控制器
 * @package App\Http\Controllers\Char
 */
class CharController extends Controller
{
    public function char_window(){
        return view('Char.Char.char_window');
    }

    /**
     * 向客户端发送消息
     */
    public function send_message(Request $request){
        if($request->isMethod('post')){
            $name = session('name');
            $message = $request->input('message');
            $client_id = $request->input('client_id');
            $msg = [
                'code'=>1,
                'type'=>2,
                'client_id'=>$client_id,
                'name'=>$name,
                'message'=>$message
            ];
            Gateway::$registerAddress = '127.0.0.1:1238';
            Gateway::sendToUid(json_encode($msg));
            return $msg;
        }
    }
}
