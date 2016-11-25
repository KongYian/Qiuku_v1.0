<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台登录</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="static/css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="static/js/jquery-3.1.1.min.js"></script>
    <script src="static/js/verificationNumbers.js" ></script>
    <script src="static/js/Particleground.js"></script>
    <script>
        //粒子背景特效
        $(document).ready(function() {
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //验证码
            createCode();
            //code为验证码的字符串
            //用户登录验证
            $('.submit_btn').click(function () {
                var $name = $('.user_icon input').val();
                var $pwd = $('.pwd_icon input').val();
                var $vcode = $('.val_icon input').val();
                if (!$name || !$pwd || !$vcode) {
                    alert('填写有误！请重新填写');
                    createCode();
                }else{
                    //设置不区分大小写
                    if (($vcode.toUpperCase()) != code.toUpperCase()) {
                        alert('验证码错误，请重新填写');
                        createCode();
                    }else{
                        var $param = {
                            'userName': $name,
                            'userPassword': $pwd
                        }
                        console.log($param);
                        $.ajax({
                            url: 'ajax/loginAjax.php',
                            data: $param,
                            dataType: 'json',
                            type: 'post',
                            success: function (data) {
                                if(data.status == 1){
                                    alert(data.info);
                                    window.location.href='./index.php';
                                }else{
                                    createCode();
                                }
                            },
                            error: function () {
                                alert('页面出错啦,请重新登录');
                                window.location.href = '#';
                            }
                        })
                    }
                }
             })
         });
    </script>
</head>
<body>
<dl class="admin_login">
    <dt>
        <strong>服务器监测管理系统</strong>
        <em>Welcome```</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="账号" class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" class="login_txtbx"/>
    </dd>
    <dd class="val_icon">
        <div class="checkcode">
            <input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx">
            <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
        </div>
        <input type="button" value="验证码核验" class="ver_btn" onClick="validate();">
    </dd>
    <dd>
        <input type="button" value="立即登陆" class="submit_btn" />
    </dd>
    <dd>
        <p>© 2015-2016</p>
        <p>michael</p>
    </dd>
</dl>
</body>
</html>
