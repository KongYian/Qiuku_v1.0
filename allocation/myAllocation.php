<?php
require_once '../model/Mysession.class.php';
require_once '../model/Mymysqli.class.php';
$msession = new Mysession();
$msession->checkSession();
?>
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
            //操作的类型
            var $btnflag;
            var $url = '../ajax/myAllocationAjax.php';
            var $param;
            var $aid;
            var $uid=<?php echo $msession->get();?>;
            ;
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            //激活按钮
            $('table').on('click','.activatebtn',function (){
                $aid = $(this).data('aid');
                //data属性的兼容问题
//                var $value = $(this).val();
                $btnflag = 1;
                $param={'btnflag':$btnflag,'aid':$aid,'uid':$uid};
                var $btn = $(this);
                var $obj = $btn.parent().prev().children();
                $.ajax({
                    url: $url,
                    data: $param,
                    type:'post',
                    dataType:'json',
                    success:function (data) {
                        console.log(data);
//                        window.location.href=window.location.href;
                        //给激活按钮添加 activestopbtn的类属性，改变文字，状态下面的按钮【未激活】变为【激活中】，添加属性，改变文字
                        $btn.removeClass().addClass("btn btn-warning btn-lg activatestopbtn");
                        $btn.text('停止激活');
                        $obj.removeClass().addClass("btn btn-success btn-lg");
                        $obj.text('激活中');
                    }
                })
            });




            //停止激活按钮
            $('table').on('click','.activatestopbtn',function (){
                $aid = $(this).data('aid');
                //data属性的兼容问题
//                var $value = $(this).val();
                $btnflag = 2;
                $param={'btnflag':$btnflag,'aid':$aid,'uid':$uid};
                var $btn = $(this);
                var $obj = $btn.parent().prev().children();
                $.ajax({
                    url: $url,
                    data: $param,
                    type:'post',
                    dataType:'json',
                    success:function (data) {
                        console.log(data);
//                        window.location.href=window.location.href;
                        //给激活按钮添加 activestopbtn的类属性，改变文字，状态下面的按钮【未激活】变为【激活中】，添加属性，改变文字
                        $btn.removeClass().addClass("btn btn-primary btn-lg activatebtn");
                        $btn.text('激活');
                        $obj.removeClass().addClass("btn btn-default btn-lg");
                        $obj.text("未激活");
                    }
                })
            });

            //删除按钮
            $('.deletebtn').click(function () {
                $aid = $(this).data('aid');
                //获取这一行tr的对象
                var $obj = $(this).parent().parent();
                console.log($obj);
                //data属性的兼容问题
//                var $value = $(this).val();
                $btnflag = 3;
                $param={'btnflag':$btnflag,'aid':$aid,'uid':$uid};
                console.log($param);
                $.ajax({
                    url: $url,
                    data: $param,
                    type:'post',
                    dataType:'json',
                    success:function (data) {
                        console.log(data);
                        $obj.remove();
//                        window.location.href=window.location.href;
                    }
                })

            })
        });

    </script>
</head>
<body>
<hr>
<a href="addAllocation.php"><button type="button" class="btn btn-primary">新增配置</button></a>
<hr>
<h1>以下是我所有的配置 以及 配置的操作（删除，编辑，是否开启）</h1>


<form>
<table class="table table-striped">
        <tr class="info">
            <td><h2>应用描述</h2></td>
            <td><h2>状态</h2></td>
            <td><h2>操作</h2></td>
        </tr>
    <?php
    $uid = $msession->get();
    $mysqli = new Mymysqli();
    $sql = "SELECT `allocationId`,`appDescription`,`status`,`userId` FROM `ob_allocationInfo` WHERE `userId`='{$uid}'";
    $pr = $mysqli->mSelectAll($sql);

    while($res = $pr->fetch_assoc()){
        echo "<tr class='success'>";
        echo "<td>".$res['appDescription']."</td>";

        echo "<td>";
        if($res['status']==0){
            echo "<button type=\"button\" class=\"btn btn-default btn-lg\">未激活</button>";
        }else{
            echo "<button type=\"button\" class=\"btn btn-success btn-lg\">激活中</button>";
        }
        echo "</td>";

        //点击启动，将【未激活】状态改为【正在监测】
        //点击修改,跳转到修改界面，或者用js弹框展示，进行修改
        //点击删除，将此条记录删除，无需伪删除
        echo "<td>";

        if($res['status']==0){
            echo "<button type=\"button\" class=\"btn btn-primary btn-lg activatebtn\" data-aid='{$res['allocationId']}'>激活</button>";
        }else{
            echo "<button type=\"button\" class=\"btn btn-warning btn-lg activatestopbtn\" data-aid='{$res['allocationId']}'>停止激活</button>";

        }
        echo "<a href=\"editAllocation.php/?aid={$res['allocationId']}&uid={$res['userId']}\"><button type=\"button\" class=\"btn btn-info btn-lg modifybtn\" data-aid='{$res['allocationId']}'>修改</button></a>";
        echo "<button type=\"button\" class=\"btn btn-danger btn-lg deletebtn\" data-aid='{$res['allocationId']}'>删除</button>";
        echo "</td>";

        echo "</tr>";
    }

    ?>
</table>
</form>
<a href="../index.php"><button type="button" class="btn btn-primary">回到首页</button></a>

</body>
</html>