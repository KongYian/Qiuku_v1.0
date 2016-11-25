<html>
<head>
    <meta charset="utf-8"/>
    <title>我的配置</title>
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
<hr>
<a href="addAllocation.php"><button type="button" class="btn btn-primary">新增配置</button></a>
<hr>
<h1>以下是我所有的配置 以及 配置的操作（删除，编辑，是否开启）</h1>

</body>
</html>