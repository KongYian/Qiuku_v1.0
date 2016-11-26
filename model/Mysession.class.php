<?php
/**
 * Session控制类
 */

session_start();
class Mysession{
    //用数学表达式在线上会报错 60 * min 60*60*24
    const EXPIRE = 86400;
    const SNAME = 'userinfo';

    public function set($uid,$name){
        $session_data = array();
        $session_data['uid'] = $uid;
        $session_data['data'] = $name;
        $session_data['expire'] = time()+Mysession::EXPIRE;
        $_SESSION[Mysession::SNAME] = $session_data;
    }

    public function get(){
        if(isset($_SESSION[Mysession::SNAME])){
            if($_SESSION[Mysession::SNAME]['expire']>time()){
                return $_SESSION[Mysession::SNAME]['uid'];
            }else{
                $this->clear();
            }
        }
        return false;
    }

    /**
     * @param string $path
     */
    public function checkSession($path='login.php'){
        if(!($_SESSION[Mysession::SNAME])){
            echo "<script>
                 alert('请先登录');
                 window.location.href='$path';
                </script>";
        }elseif(time() - $_SESSION[Mysession::SNAME]['expire'] > Mysession::EXPIRE){
            echo "<script>
                  alert('网页超时，请重新登录');
                  window.location.href='$path';
                </script>";
            $this->clear();
        }
    }

    private function clear(){
        unset($_SESSION[Mysession::SNAME]);
        //清楚客户端的session
//        if(isset($_COOKIE[session_name()]))
//        {
//            setCookie(session_name(),'',time()-3600,'/');
//        }
//        session_destroy();
        //清楚服务器端的session
    }

    public function logout(){
        $this->clear();
    }
}

