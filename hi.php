<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016/11/26
 * Time: 下午5:26
 */

$arr = array(
    'name'=>'tao',
    'gender'=>'male'
);

$hi = implode('|',$arr);

array_push($arr,$hi);
var_dump($arr);
echo $hi;
//var_dump($arr);