<html>
<head>
    <meta charset="utf-8"/>
    <title>监控信息配置</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="../static/css/style.css" />
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="../static/js/jquery-3.1.1.min.js"></script>
    <script src="../static/js/verificationNumbers.js" ></script>
    <script src="../static/js/Particleground.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //验证码
            createCode();
            //测试提交，对接程序删除即可
            $(".submit_btn").click(function(){
                location.href="javascrpt:;"/*tpa=http://***index.html*/;
            });
        });
    </script>
</head>
<body>

<body class="layui-main">

<hr>
<h1>监控信息配置</h1>
<hr>
<!--这里应该根据Ip、服务器名称来自动填充一些信息-->
<form class="layui-form layui-main" action="">
    <!--服务器名称-->
    <div class="layui-form-item">
        <label class="layui-form-label">服务器名称</label>
        <div class="layui-input-inline">
            <input type="text" name="serverName" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
        <!--服务器IP-->
        <label class="layui-form-label">服务器IP</label>
        <div class="layui-input-inline">
            <input type="text" name="serverIp" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
        <!--服务器OS-->
        <label class="layui-form-label">服务器OS</label>
        <div class="layui-input-inline">
            <input type="text" name="serverOs" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <!--应用名称-->
    <div class="layui-form-item">
        <label class="layui-form-label">应用名称</label>
        <div class="layui-input-inline">
            <input type="text" name="appname" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
        <!--域名-->
        <label class="layui-form-label">域名</label>
        <div class="layui-input-inline">
            <input type="text" name="domain" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
        <!--应用端口-->
        <label class="layui-form-label">应用端口</label>
        <div class="layui-input-inline">
            <input type="text" name="appport" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <!--CPU使用率报警值-->
    <div class="layui-form-item">
        <label class="layui-form-label">CPU使用率报警值</label>
        <div class="layui-input-inline">
            <input type="text" name="cpucaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <!--内存占用率报警值-->
    <div class="layui-form-item">
        <label class="layui-form-label">内存占用率报警值</label>
        <div class="layui-input-inline">
            <input type="text" name="memcaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <!--硬盘占用率报警值-->
    <div class="layui-form-item">
        <label class="layui-form-label">硬盘占用率报警值</label>
        <div class="layui-input-inline">
            <input type="text" name="hdcaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <!--负载均衡报警值-->
    <div class="layui-form-item">
        <label class="layui-form-label">负载均衡报警值</label>
        <div class="layui-input-inline">
            <input type="text" name="loadaveragecaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <!--记录的频率-->
    <div class="layui-form-item">
        <label class="layui-form-label">记录频率</label>
        <div class="layui-input-inline">
            <select name="recordFrequency">
                <option value="1"selected="">一分钟</option>
                <option value="2">两分钟</option>
                <option value="5">五分钟</option>
                <option value="10">十分钟</option>
                <option value="20">二十分钟</option>
            </select>
        </div>
    </div>
    <!--创建时间-->
    <div><input type="hidden" name="createTime" value="<?php echo @date('Y-m-d H:m:s',time());?>"></div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-warm" id="subsettings">保存配置</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
</html>