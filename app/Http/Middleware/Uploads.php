<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;

class Uploads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $name = $request->input('name');
//        $file = $request->file($name);
        //获取文件相关信息
//        $request->ext = $file->getClientOriginalExtension();     //文件扩展名
//        if(!in_array($request->ext,config('uploadConfig.'.$name.'.ext'))){
//            $request->error = 1;;
////            return redirect();
////            重定向到另一个页面
//        }
        return $next($request);
    }
}
