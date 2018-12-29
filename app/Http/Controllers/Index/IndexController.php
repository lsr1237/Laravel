<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\12\17 0017
 * Time: 10:15
 */

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Upload\Upload;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\View;

class IndexController extends Controller
{


    public function test_middleware(){
        echo '登录成功';
        $assign = [];
//        return view('index.index.head',$assign);
    }
    public function login(){
        //登录页面
        $assign = [
            'name'=>'lsr',
        ];
        return view('index.index.login',$assign);
    }
    public function login_in(Request $request){
        echo $request->method();
        if($request->isMethod('post')) {
            $name = $request->username;
            $password =$request->password;
            echo '用户名：'.$name;
            echo '密码：'.$password;
            $password = DB::table('users')->select()->where('name','=',$name)->first();
            if(!empty($password->password)){
                echo '数据库密码：'.$password->password;
                if(Hash::check($request->password,$password->password)){
                    //存入session
                    session(['name'=>$name]);
                    return redirect('Index/Index/index');
                    if(Hash::needsrehash($password->password)){
                        //工作因子改变
                        echo '请重新加密';
                    }
                }
            }
            return redirect('Index/Index/login');
        }
    }

    public function welcome(){
        return view('Index.Index.welcome');
    }
    public function upload(Request $request, Storage $storage){
        if($request->isMethod('post'))
        {
            $name = $request->input('name');
            if($request->middileware_msg['code'] == 1){
                $file = $request->file($name);
                //获取文件相关信息
//                    $originalName = $file->getClientOriginalName();   // 文件原名
//                    $type = $file->getClientMimeType();
                $ext = $file->getClientOriginalExtension();        //获取文件的拓展名
                $realPath = $file->getRealPath();       //临时文件的绝对路径
                //生成文件名
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                //保存文件
                $bool = Storage::disk(config('uploadConfig.save_path.'.$name))->put($filename, file_get_contents($realPath));
                if($bool){
                    //将上传记录存储到数据库中
                    //上传文件类型
                    $type_array = [
                        'file'=>1,
                        'image'=>2,
                        'video'=>3
                    ];
                    $save_data = [
                        [
                            'user_id'=>'1',
                            'file_path'=>"/storage/app/uploads/".$name.'/'.$filename,
                            'file_type'=>$type_array[$name],
                            'upload_time'=>date('Y-m-d H:i:s'),
                        ],
                    ];
                    DB::table('upload_file')->insert($save_data);
                    $msg = [
                        'code'=>1,
                        'msg'=>'文件上传成功！',
                        'size'=>$file->getClientSize(),
                    ];
                }else{
                    $msg = [
                        'code'=>0,
                        'msg'=>'文件上传失败！',
                    ];
                }
            }else{
                $msg = $request->middileware_msg;
            }
        }else{
            $msg = [
                'code'=>0,
                'msg'=>'非法操作'
            ];
        }
        return json_encode($msg);
    }

    public function index(){
        return view('Index.Index.index');
    }

    /**
     * 测试数据库操作
     * crud
     * 操作数据库——users
     */
    public function test(Request $request){
        if($request->input('dotype') == 'insert'){
            //造个假数据
            for($i=0;$i<100;$i++){
                $save_data = [
                    'name'=>'lsr'.$i,
                    'email'=>$i.'@qq.com',
                    'password'=>Hash::make('123456'),
                ];
                DB::table('users')->insert($save_data);
            }
            echo '好了';
            //插入数据库
//            $insert_data = [
//                [
//                    'name'=>'lsr',
//                    'email'=>'1@qq,com',
//                    'password'=>md5('123456')
//                ],
//                [
//                    'name'=>'xxy',
//                    'email'=>'2@qq.com',
//                    'password'=>Hash::make('123456'),
//                ],
//                [
//                    'name'=>'dsb',
//                    'email'=>'3@qq.com',
//                    'password'=>Hash::make('123456'),
//                ]
//            ];
//            echo DB::table('users')->insert($insert_data);
        }elseif($request->input('dotype') == 'update'){
            //更新操作
            DB::table('users')->where('id',1)->update(['password'=>md5('123456')]);
            DB::table('users')->whereIn('id',[2,3])->update(['password'=>Hash::make('123456')]);
//            DB::table('users')->update(['remember_token'=>time()]);
//            DB::table('users')->update(['created_at'=>date('Y-M-D H:i:s')]);
//            DB::table('users')->update(['updated_at'=>time()]);
        }elseif($request->input('dotype') == 'select'){
            //查询操作
            $data = DB::table('users')->select('name')->whereIn('id',[1,2,3])->get()->toArray();
            var_dump($data);
            var_dump($data[0]->name);
        }elseif($request->input('dotype') == 'delete'){
            //删除操作
            DB::delete('delete from users');
        }

    }
}