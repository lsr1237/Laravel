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
<div class="x-body">
    <div class="layui-row">
            <button class="layui-btn" id="file"  name="file">上传文件</button>
    </div>
</div>
<div class="x-body">
    <div class="layui-row">
            <button class="layui-btn" id="img" name="img">上传图片</button>
    </div>
</div>
<div class="x-body">
    <div class="layui-row">
            <button class="layui-btn" id="video" name="video">上传视频</button>
    </div>
</div>
<div class="x-body">
    <div class="layui-row">
            <img src="/storage/app/uploads/file/2018-12-25-08-17-08-5c21e7848ded4.jpg">
    </div>
</div>
<script>
    layui.use('upload', function(){
        var upload = layui.upload;
        //执行实例
        var uploadInst = upload.render({
            elem: '#file' //绑定元素
            ,url: '/Index/Index/upload' //上传接口
            ,accept:'file'
            ,data:{'name':'file'}
            ,done: function(res, index, upload){
                console.log(res);
                console.log(index);
                console.log(upload);
                layer.msg(res.msg);
                if(res.code == 1){
                }else{
                }
                //上传完毕回调
            }
            ,error: function(){
                //请求异常回调
                console.log('请求错误');
            }
        });
    });
</script>
</body>

</html>