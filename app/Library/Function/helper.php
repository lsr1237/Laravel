<?php
/**
 * 公共函数
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\12\17 0017
 * Time: 10:14
 */


/**
 * 传递数据以易于阅读的样式格式化后输出
 * @param $data
 */
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
//    // 如果是boolean或者null直接显示文字；否则print
//    if (is_bool($data)) {
//        $show_data=$data ? 'true' : 'false';
//    }elseif (is_null($data)) {
//        $show_data='null';
//    }else{
//        $show_data=print_r($data,true);
//    }

    $show_data = print_r(ca($data),true);;
    $str.= $show_data;
    $str.='</pre>';
    echo $str;
}

function ca($data){
    if(is_array($data)){
        return array_map('ca',$data);
    }else{
        if(is_bool($data)){
            $show_data = $data ? 'true' : 'false';
        }elseif(is_null($data)){
            $show_data = 'null';
        }else{
            $show_data = $data;
        }
        return $show_data;
    }
}
