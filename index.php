<?php
    require_once 'model/Mysession.class.php';
    require_once 'model/Mymysqli.class.php';
    $msession = new Mysession();
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

            //checkbox绑定事件
            console.log($('.opt input[type=checkbox]'));
            $('.opt input[type=checkbox]').click(function () {
                var $checkboxflag = $(this).attr('checked');
                if($checkboxflag == 'checked'){
                    $(this).removeAttr('checked');
//                    console.log($(this).attr('checked'))

                }else{
                    $(this).attr("checked",true);
//                    console.log($(this).attr('checked'))
                }
            })


            //开始监测
            $('.watchOpt').on('click','.startWatch',function () {
                var $btn = $(this);
                var $url ='ajax/indexAjax.php';
                //开始监测的标志
                var $flag = 1;
                //获得这个BUTTON的父元素
                var $tr = $btn.parents('.success');
                //获取到选择框所在的td
                var $select = $tr.children().eq(1);
//                console.log($tr.children());
                //获取到checkbox
                var $checkbox = $select.children().children();
//                console.log($checkbox);
                $.each($checkbox,function (index,domobj) {
                    console.log(domobj.getAttribute('checked'));
//                    console.log(index);

                    if(domobj.getAttribute('checked')){
                        console.log(index);
                    }
//                    console.log(domobj);
                })




//                console.log($select);
//                console.log($checkbox);
                var $param={'flag':$flag,};
//                $btn.removeClass().addClass('btn btn-success btn-lg watchError');
//                $btn.text('监测中...')
//                $btn.next().removeClass('watchError');

                $.ajax({
                    url:$url,
                    data:$param,
                    dataType:'json',
                    type:'post',
                    success:function (data) {
                        //调出监测的窗口
                        //【开始监测】按钮变为【监测中...】
                        $btn.removeClass().addClass('btn btn-success btn-lg watchError');
                        $btn.text('监测中...')
                        $btn.next().removeClass('watchError');
                    },
                    error:function () {

                    }
                });
            });
            //停止监测
            $('.watchOpt').on('click','.stopWatch',function () {
                var $btn = $(this);
                var $url ='ajax/indexAjax.php';
                var $param;
                $btn.prev().removeClass().addClass('btn btn-primary btn-lg startWatch');
                $btn.prev().text('开始检测');
                $btn    .addClass('watchError')

//                $.ajax({
//                    url:$url,
//                    data:$param,
//                    dataType:'json',
//                    type:'post',
//                    success:function (data) {
//                        //删除监测的窗口
//                        //【监测中...】变为【开始监测】
//                    },
//                    error:function () {
//
//                    }
//                });
            });

            $('.watchOpt').on('click','.watchError',function () {
                alert('invalid function');
            });

            });
    </script>
</head>
<body>
<hr>
<a href="controller/logout.php"><button type="button" class="btn btn-primary" id="logout">退出登录</button></a>
<hr>
<a href="allocation/myAllocation.php"><button type="button" class="btn btn-primary">我的配置</button></a>
<table class="table table-bordered watchOpt">
    <tr class="info">
        <td>已激活监控对象</td>
        <td>监控项目</td>
        <td>操作</td>
    </tr>

    <?php
    $uid = $msession->get();
    $mysqli = new Mymysqli();
    $sql = "SELECT `allocationId`,`appDescription` FROM `ob_allocationInfo` WHERE `userId`='{$uid}' AND `status`=1";
    $pr = $mysqli->mSelectAll($sql);

    while($res = $pr->fetch_assoc()){
        echo "<tr class='success'>";
        echo "<td>".$res['appDescription']."</td>";

        echo "<td>";
        echo "<div class='opt'>
            CPU<input type=\"checkbox\" name=\"monitor[cpu]\" title=\"CPU使用率\" value=\"1\">
            MEM<input type=\"checkbox\" name=\"monitor[mem]\" title=\"内存占用率\" value=\"1\">
            HD<input type=\"checkbox\" name=\"monitor[hd]\" title=\"硬盘可用空间\" value=\"1\">
            TASK<input type=\"checkbox\" name=\"monitor[task]\" title=\"正在运行的进程数\" value=\"1\">
            LOAD<input type=\"checkbox\" name=\"monitor[loadaveage]\" title=\"负载均衡值\" value=\"1\">
            PORT<input type=\"checkbox\" name=\"monitor[online]\" title=\"端口连接数目\" value=\"1\">
              </div>";
        echo "</td>";

        //点击【开始监测】，创建一个监控窗口
        //点击【停止监测】，删除一个监控窗口
        echo "<td>";
        echo "<button type=\"button\" class=\"btn btn-primary btn-lg startWatch\" data-id='{$res['allocationId']}'>开始监测</button>";
        echo "<button type=\"button\" class=\"btn btn-danger btn-lg stopWatch watchError\" data-id='{$res['allocationId']}'>停止监测</button>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<div class="table-responsive">
    <table class="table">
        <tr>
            <td class="active">CPU</td>
            <td class="success">MEM</td>
            <td class="warning">HD</td>
            <td class="danger">TASK</td>
            <td class="info">LOAD</td>
            <td class="info">PORT</td>
        </tr>
    </table>
</div>

</body>
</html>