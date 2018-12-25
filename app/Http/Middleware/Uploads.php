<?php

namespace App\Http\Middleware;


use Closure;

class Uploads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 上传文件的中间件
     * 用于检测文件的大小、拓展名等。
     */
    public function handle($request, Closure $next)
    {
        $name = $request->input('name');
        $file = $request->file($name);
        if($request->hasFile($name) && $file->isValid()){
//        获取文件相关信息
            $ext = $file->getClientOriginalExtension();     //文件扩展名
            $size = $file->getClientSize();  //获取文件大小
            $limit_size = config('uploadConfig.'.$name.'.size');
            if(!in_array($ext,config('uploadConfig.'.$name.'.ext'))){
                $msg = [
                    'code'=>0,
                    'msg'=>'上传文件格式不正确！',
                ];
//            return redirect();
//            重定向到另一个页面
            }elseif($size > $limit_size){
                $msg = [
                    'code'=>0,
                    'msg'=>'上传文件大小为'.$size.',大于'.$limit_size,
                ];
            }else{
                $msg = [
                    'code'=>1,
                    'msg'=>'success',
                ];
            }
        }else{
            $msg = [
                'code'=>0,
                'msg'=>'未能检测到上传的文件！'
            ];
        }

        //传递中间件参数
        $request->middileware_msg = $msg;
        return $next($request);
    }
}
