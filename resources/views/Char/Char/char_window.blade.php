<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<style>
    .layui-min-height{
        height:500px;
        overflow-y:auto
    }
    .layui-height{
        height:600px;
    }
    .layui-top{
        margin-top:100px;
        border-radius:5px;
    }
    .layui-font{
        color:black;
    }
    .layui-p{
        margin:10px 0px 10px 5px;
    }
    .layui-footer{
        margin-top: 10px;
    }
</style>
<div class="layui-main layui-bg-black layui-height layui-top"   >
    <blockquote class="layui-elem-quote layui-font">聊天窗口</blockquote>
    <div id="char_window" class="layui-min-height">
    </div>
    <div class="layui-footer">
        <input class="layui-input" type="text" name="title" required lay-verify="required" placeholder="请输入消息" autocomplete="off" id="message">
        <button class="layui-btn layui-btn-fluid" id="send_message">发送</button>
    </div>

</div>
<script>
    //异步发送消息
    var conn = 1;
    var client_id ;
    $('#send_message').click(function(){
        console.log('发送了消息');
        var message = $('#message').val();
        if(message.length == 0){
            layer.msg('消息不能为空');
            return false;
        }
        if(conn){   //判断客户端是否连接
            $.ajax({
                url:'/Char/Char/send_message',
                data:{'message':message,'client_id':client_id},
                type:'POST',
                datatype:'json',
                success:function(data){
                    console.log(data);
                    if(data['code'] == 1){
                        layer.msg('消息发送成功！');
                        $('#char_window').append('<p class="layui-p">me>  '+data['message']+'</p>');
                        $('#message').val('');
                    }else{
                        layer.msg('消息发送失败！');
                    }
                }
            })
        }else{
            layer.msg('连接服务器失败！请重试！');
        }
    })

    //回车事件绑定
    $('#message').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            //回车执行查询
            $('#send_message').click();
        }
    });
</script>
<script>
    // 创建一个WebSocket对象
    function conn_socket(){
        var ws = new WebSocket('ws:'+document.domain+':8282');
        if(ws.readyState == 3)  //0 - 表示连接尚未建立。1 - 表示连接已建立，可以进行通信。2 - 表示连接正在进行关闭。3 - 表示连接已经关闭或者连接不能打开。
        {
            console.log('连接失败！');
            setTimeout(conn_socket,5000);//未连接重新发起请求
            return false;
        }
        ws.onopen = onopen; //当建立该连接时触发该方法
        ws.onmessage = onmessage; //当客户端收到服务端消息时触发
        ws.onerror = onerror;   //当通信错误时触发
        ws.onclose = onclose;   //当连接关闭时触发
        function onopen(){
            // console.log('建立连接！');
        }
        function onmessage(evt){
            console.log(evt.data);
            console.log(JSON.parse(evt.data));
            var data = JSON.parse(evt.data);
            if(data['code'] == 1 && data['type'] == 1){         //连接时调用
                client_id = data['client_id'];
                $.ajax({
                    url: '/Client/Client/bind',
                    data: {'client_id':data['client_id']},
                    type: 'POST',
                    datatype: 'json',
                    beforeSend:function(){
                        // console.log('开始调用接口绑定client_id');
                    },
                    success:function(res){
                        console.log('绑定结果');
                        console.log(JSON.parse(res)[0]);
                    },error:function(){

                    }
                })
            }else if(data['code'] == 1 && data['type'] == 2){       //接收到用户消息
                console.log(client_id);
                if(data['client_id'] != client_id){     //判断是不是自己发送的消息
                    $('#char_window').append('<p class="layui-p">'+data['name']+'>  '+data['message']+'</p>');
                }

            }
            // console.log('发送消息');
            // ws.send('随便整点');
        }
        function onerror(){
            console.log('连接错误！');
            setTimeout(conn_socket,5000);//未连接重新发起请求
            return false;
            //请求接口解除绑定
        }
        function onclose(){
            console.log('连接关闭！');
            setTimeout(conn_socket,5000);//未连接重新发起请求
            return false;
            //请求接口解除绑定
        }
    }
    function unbind(){
        $.ajax({
            url:'Client/Client/unbind_client_id',
            data:{'client_id':client_id},
            type:'POST',
            async:true,
            success:function(data){
                console.log(data);
            }

        })
    }
    conn_socket();

</script>
</body>

</html>