<?php
/**
 * Session控制类
 */

session_start();
class Mysession{
    //用数学表达式在线上会报错 60 * min 60*60*24
    const EXPIRE = 86400;

    private $sname;

    public function __construct($sname){
        $this->sname = $sname;
    }

    public function set(){
        $session_data = array();
        $session_data['data'] = $this->sname;
        $session_data['expire'] = time()+Mysession::EXPIRE;
        $_SESSION[$this->sname] = $session_data;
    }

    public function get(){
        if(isset($_SESSION[$this->sname])){
            if($_SESSION[$this->sname]['expire']>time()){
                return $_SESSION[$this->sname];
            }else{
                self::clear($this->sname);
            }
        }
        return false;
    }

    /**
     * @param string $path
     */
    public function checkSession($path='login.php'){
        if(!($_SESSION[$this->sname])){
            echo "<script>
                 alert('请先登录');
                 window.location.href='$path';
                </script>";
        }elseif(time() - $_SESSION[$this->sname]['expire'] > Mysession::EXPIRE){
            echo "<script>
                  alert('网页超时，请重新登录');
                  window.location.href='$path';
                </script>";
            $this->clear();
        }
    }

    private function clear(){
        //清楚客户端的session
        if(isset($_COOKIE[session_name()]))
        {
            setCookie(session_name(),'',time()-3600,'/');
        }
        session_destroy();
        //清楚服务器端的session
        unset($_SESSION[$this->sname]);
    }

//    public function logout(){
//        $this->clear();
//    }
}

