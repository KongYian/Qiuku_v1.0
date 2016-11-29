<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016/11/28
 * Time: 下午1:54
 */
require_once '../model/Mysession.class.php';
require_once '../model/Mymysqli.class.php';
$msession = new Mysession();
$msession->checkSession();
?>

<?php
$aid = $_GET['aid'];
$uid = $_GET['uid'];
$mysqli = new Mymysqli();
$sql = "SELECT * FROM `ob_allocationInfo` WHERE `allocationId`='{$aid}' AND `userId`='{$uid}'";
$res = $mysqli->mSelect($sql);
$tsql = "SELECT * FROM `ob_serverInfo` WHERE `serverId`='{$res['serverId']}'";
$tres = $mysqli->mSelect($tsql);
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>监控信息配置</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css" />
    <link rel="stylesheet" href="../../static/css/bootstrap.min.css">
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="../../static/js/jquery-3.1.1.min.js"></script>
    <script src="../../static/js/verificationNumbers.js" ></script>
    <script src="../../static/js/Particleground.js"></script>
    <script>
        $(document).ready(function() {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });

            var $recordFrequency = <?php echo $res['recordFrequency'] ?>
            //获取select对象，遍历，添加属性
            var $selectObj = $('select option');
            $.each($selectObj,function (index,domobj) {
//                alert(domobj);
               if((domobj.value)*1 == $recordFrequency){
                   domobj.setAttribute("selected",true);
               }
            });

            //配置修改提交
            $('#submodify').click(function (ev) {
                ev.stopPropagation();
                ev.preventDefault();
                var $url = "../../ajax/editAllocationAjax.php";
//                var $url = '../ajax/myAllocationAjax.php';
                //如何将空值以0的数值传过来。
                var $param = $('form').serialize();
//                $param['aid']=<?php //echo $aid ?>
                console.log($param );
                //do something 判断非法值无法提交
                alert($param);
                $.ajax({
                    url:$url,
                    data:$param,
                    dataType:'json',
                    type:'post',
                    success:function (data) {
                        console.log(data);
//                        alert(data.info);
                        alert(data);
                    },
                    error:function () {
                        alert('操作失败');
                    }
                })
            })

        });
    </script>
</head>
<body>

<hr>
<h1>监控信息配置</h1>
<hr>
<!--这里应该根据Ip、服务器名称来自动填充一些信息-->
<!--服务器名称-->
<form>
    <input type="hidden" name="aid" value="<?php echo $aid?>">
    <input type="hidden" name="uid" value="<?php echo $uid?>">

    <label class="layui-form-label">服务器名称</label>
    <input type="text" name="serverName" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $tres['serverName']?>">

    <!--服务器IP-->
    <label class="layui-form-label">服务器IP</label>
    <input type="text" name="serverIp" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $tres['serverIp']?>">

    <!--服务器OS-->
    <label class="layui-form-label">服务器OS</label>
    <input type="text" name="serverOs" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $tres['serverOs']?>">

    <!--应用名称-->
    <label class="layui-form-label">应用名称</label>
    <input type="text" name="appName" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['appName']?>">

    <!--应用描述-->
    <label class="layui-form-label">应用描述</label>
    <input type="text" name="appDescription" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['appDescription']?>">

    <!--域名-->
    <label class="layui-form-label">域名</label>
    <input type="text" name="domain" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['domain']?>">


    <!--应用端口-->
    <label class="layui-form-label">应用端口</label>
    <input type="text" name="appPort" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['appPort']?>">


    <!--CPU使用率报警值-->
    <label class="layui-form-label">CPU使用率报警值</label>
    <input type="text" name="cpuCaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['cpuCaution']?>">
    <!--内存占用率报警值-->
    <label class="layui-form-label">内存占用率报警值</label>
    <input type="text" name="memCaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['memCaution']?>">
    <!--硬盘占用率报警值-->
    <label class="layui-form-label">硬盘占用率报警值</label>
    <input type="text" name="hdCaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['hdCaution']?>">
    <!--负载均衡报警值-->
    <label class="layui-form-label">负载均衡报警值</label>
    <input type="text" name="loadAverageCaution" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $res['loadAverageCaution']?>">
    <!--记录的频率-->
    <label class="layui-form-label">记录频率</label>
    <div class="layui-input-inline">
        <select name="recordFrequency">
            <option value="1">一分钟</option>
            <option value="2">两分钟</option>
            <option value="5">五分钟</option>
            <option value="10">十分钟</option>
            <option value="20">二十分钟</option>
        </select>
    </div>
    <!--创建时间-->
    <input type="hidden" name="modifyTime" value="<?php echo @date('Y-m-d H:m:s',time());?>"></div>

    <button  id="submodify">提交修改</button>
    <button type="reset">重置</button>
</form>
</body>
</html>