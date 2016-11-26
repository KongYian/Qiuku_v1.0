<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016/11/25
 * Time: 下午2:00
 */
//$test = new Mymysqli();
//$res = $test->mSelect("select * from `ob_userInfo`");
//$sql = "SELECT * FROM `ob_userInfo` WHERE `userName` = 'qq'";
//$res = $test->mSelect($sql);
//var_dump($res);
class Mymysqli{
    private $hostname;  //数据库连接地址
    private $username;  //用户名
    private $password;  //密码
    private $dbname;    //数据库名称
    private $tableprefix;
    private $mysqli;    //数据库实例
    private $tablename; //表名称
    private $port;      //
    private $sql;       //
    private $pr;        //select查询句柄
    private $res;       //结果集

    public function __construct(){
        $this->hostname = '127.0.0.1';
        $this->username = 'root';
        $this->password = '123123';
        $this->dbname = 'qiuku';
        $this->connectDb();
    }

    public function connectDb(){
        $this->mysqli = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
        $this->mysqli->select_db($this->dbname);
        $this->mysqli->set_charset('utf8');
    }

    public function mSelect($sql){
        $this->sql =$sql;
        $this->pr = $this->mysqli->query($this->sql) ;
        if($this->pr){
            $this->res = $this->pr->fetch_assoc();
//            var_dump($this->res);
            return $this->res;
        }else{
//            return $this->pr;
            return false;
        }
    }

    public function mInsert($sql){
        $this->sql =$sql;
        $this->pr = $this->mysqli->query($this->sql) ;
        if($this->pr){
            //如果成功的话，则返回当前记录的ID值
            return mysqli_insert_id($this->mysqli);
        }else{
            return false;
        }
    }


    public function close(){
        $this->mysqli->close();
    }

    public function __destruct()
    {
        $this->close();
    }

}
