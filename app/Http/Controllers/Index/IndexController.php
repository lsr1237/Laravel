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
use App\Http\Logic\Logic;
use App\Http\Upload\Upload;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function test_logic111(){
        $logMol = new Logic('file');
        $logMol->type = 'redis';
        $logMol->log('这是一条测试');
    }
    public function test_logic1(Logic $logic){
        $logic->log('这是另一条测试数据');
        $logic->type = 'redis';
        $logic->log('这是另二条测试数据');
    }

    public function test_logic(Logic $logic,Upload $upload){
//        $logic->type = 'redis';
        $upload->upload_img();
        $logic->log('这是另三条测试数据');
    }

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
            if(empty($request->error) && $request->hasFile($name)){
                $file = $request->file($name);
                //判断文件是否上传成功
                if($file->isValid()){
                    //获取文件相关信息
//                    $originalName = $file->getClientOriginalName();   // 文件原名
//                    $type = $file->getClientMimeType();
                    $realPath = $file->getRealPath();       //临时文件的绝对路径

                    //生成文件名
                    $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$request->ext;
                    //保存文件
                    $bool = Storage::disk(config('uploadConfig.save_path.'.$request->input('name')))->put($filename, file_get_contents($realPath));
                    if($bool){
                        $msg = [
                            'code'=>1,
                            'status'=>'success',
                            'msg'=>'文件上传成功！',
                        ];
                    }
                }
            }else{
                $msg = [
                    'code'=>0,
                    'status'=>'error',
                    'msg'=>'文件格式错误！'
                ];
            }

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
            //插入数据库
            $insert_data = [
                [
                    'name'=>'lsr',
                    'email'=>'1@qq,com',
                    'password'=>md5('123456')
                ],
                [
                    'name'=>'xxy',
                    'email'=>'2@qq.com',
                    'password'=>Hash::make('123456'),
                ],
                [
                    'name'=>'dsb',
                    'email'=>'3@qq.com',
                    'password'=>Hash::make('123456'),
                ]
            ];
            echo DB::table('users')->insert($insert_data);
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