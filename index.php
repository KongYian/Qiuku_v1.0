<?php
    require_once 'model/Mysession.class.php';
    require_once 'model/Mymysqli.class.php';

    $msession = new Mysession('admin');
    $msession->checkSession();
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>后台首页</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="static/css/style.css" />
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="static/js/jquery-3.1.1.min.js"></script>
    <script src="static/js/verificationNumbers.js" ></script>
    <script src="static/js/Particleground.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });


        });
    </script>
</head>
<body>
<hr>
<a href="controller/logout.php"><button type="button" class="btn btn-primary" id="logout">退出登录</button></a>
<hr>
<a href="allocation/myAllocation.php"><button type="button" class="btn btn-primary">我的配置</button></a>
<hr>
<h1>已选择监控对象</h1><br>
<h1>这里是监控的选项</h1>
<h1>这里是监控的窗口</h1>
<hr>
<button type="button" class="btn btn-primary">开始监测</button>
<button type="button" class="btn btn-primary">停止监测</button>
<hr>

</body>
</html>