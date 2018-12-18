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

class IndexController extends Controller
{
    public function test_middleware(){
        echo '登录成功';
        $assign = [];
//        return view('index.index.head',$assign);
    }
    public function login(){
        echo '请登录';
    }

    public function index($id, Request $request){
        $test_str = 'test laravel id = '.$id.'~name:'.$request->input('name');
//        echo $test_str;
        $assign = [
            'name' => 'lsr',
            'age' => 18,
            'true'=>true,
            'false'=>false,
            'null'=>null
        ];
        p($assign);
        return view('Index.Index.index',$assign);
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