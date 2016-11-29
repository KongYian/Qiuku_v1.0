<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016/11/28
 * Time: 下午5:12
 */

require_once '../model/Mymysqli.class.php';


//获取到的post值
//implode('|',$_POST);
$aid = $_GET['aid'];
$uid = $_GET['uid'];
$allocation['serverName'] = $_POST['serverName'];
$allocation['serverIp'] = $_POST['serverIp'];
$allocation['serverOs'] = $_POST['serverOs'];
$allocation['appName'] = $_POST['appName'];
$allocation['appDescription'] = $_POST['appDescription'];
$allocation['domain'] = $_POST['domain'];
$allocation['appPort'] = $_POST['appPort'];
$allocation['cpuCaution'] = $_POST['cpuCaution'];
$allocation['memCaution'] = $_POST['memCaution'];
$allocation['hdCaution'] = $_POST['hdCaution'];
$allocation['loadAverageCaution'] = $_POST['loadAverageCaution'];
$allocation['recordFrequency'] = $_POST['recordFrequency'];
$allocation['modifyTime'] = $_POST['modifyTime'];

$mysqli = new Mymysqli();
//此处要进行判断
//假如是服务器已经存在不插入，只读。
//$sql = "INSERT INTO `ob_serverInfo`(`serverName`,`serverIp`,`serverOs`) ";
//$sql .= " VALUES('{$allocation['serverName']}','{$allocation['serverIp']}','{$allocation['serverOs']}')";
//$sid = $mysqli->mInsert($sql);
//$asql = "INSERT INTO `ob_allocationInfo` ( `userId`,`serverId`,`appName`,`appDescription`,`domain`,`appPort`,`cpuCaution`,`memCaution`,`hdCaution`,`loadAverageCaution`,`recordFrequency`,`createTime`,`modifyTime`,`status`)";
//$asql .= " VALUES('{$uid}','{$sid}','{$allocation['appName'] }','{$allocation['appDescription']}','{$allocation['domain']}','{$allocation['appPort']}','{$allocation['cpuCaution']}','{$allocation['memCaution']}','{$allocation['hdCaution']}','{$allocation['loadAverageCaution']}','{$allocation['recordFrequency']}','{$allocation['createTime']}','{$allocation['createTime']}','0') ";
//$aid = $mysqli->mInsert($asql);
//if($sid && $aid){
//    $out = array(
//        'info'=>'提交成功'
//    );
//}else{
//    $out = array(
//        'info'=>'提交失败，请重新提交'
//    );
//}
echo json_encode($out);