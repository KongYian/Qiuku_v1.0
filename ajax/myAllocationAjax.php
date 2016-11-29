<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016/11/28
 * Time: 上午10:21
 */

require_once '../model/Mymysqli.class.php';
//require_once '../model/Mysession.class.php';


//$btnflag 1激活，2停止激活，3，删除

$btnflag = $_POST['btnflag'];
$aid = $_POST['aid'];
$uid = $_POST['uid'];


$mysqli = new Mymysqli();

if($btnflag == 1){
    $sql = "UPDATE `ob_allocationInfo` SET `status`=1 WHERE `allocationId`='{$aid}' AND `userId`='{$uid}'";
    $mysqli->mUpdate($sql);
    $out = array($sql);
}elseif ($btnflag == 2){
    $sql = "UPDATE `ob_allocationInfo` SET `status`=0 WHERE `allocationId`='{$aid}' AND `userId`='{$uid}'";
    $mysqli->mUpdate($sql);
    $out = array($sql);
}elseif ($btnflag == 3){
    $sql = "DELETE FROM `ob_allocationInfo` WHERE `allocationId`='{$aid}' AND `userId`='{$uid}'";
    $mysqli->mDelete($sql);
//    $out = array('info'=>'删除成功');
    $out = array($sql);
}


echo json_encode($out);