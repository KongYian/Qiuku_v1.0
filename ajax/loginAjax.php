<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016/11/25
 * Time: 下午1:46
 */

require_once '../model/Mysession.class.php';
require_once '../model/Mymysqli.class.php';
header("Content-type:text/html;charset=utf-8");


$name = trim($_POST['userName']);
$pwd = trim($_POST['userPassword']);


if($name && $pwd){
    $mysqli = new Mymysqli();
    $sql = "SELECT * FROM `ob_userInfo` WHERE `userName` = '{$name}'";
    $res = $mysqli->mSelect($sql);
    if(!$res){
        $out = array(
            'status'=>0,
            'info'=>'用户不存在,请重新登录'
        );
    }else{
        if($pwd == $res['userPassword']){
            $msession = new Mysession($name);
            $msession->set();
            $out = array(
                'status'=>1,
                'info'=>'登录成功,即将自动跳转',
            );
        }else{
            $out = array
            (
                'status'=>0,
                'info'=>'密码错误,请重新登录'
            );
        }
    }
}
echo json_encode($out);
