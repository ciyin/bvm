<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/22
 * Time: 15:18
 */
class Login extends Action {
//    登录
    public function loginCheck(){
//        验证用户名和密码
        $result = $this->model->verify($_REQUEST['username'], $_REQUEST['password']);
        $rows = $this->model->rows;
//        如果用户名和密码都正确，先给预定义的变量赋值再拼接页面
        if ($rows) {
//            1、将用户信息赋值给session
            $_SESSION['isLogin']=true;
            $_SESSION['user']=$result['user'];
            $_SESSION['user_id']=$result['id'];
            $_SESSION['role']=$result['roles_id'];
            $this->smarty->assign('user', $_SESSION['user']);
//            2、查询所有教材并显示教材列表
            $and='';
            $list = $this->model->selectList($and);
            $rows=$this->model->rows;
            $this->smarty->assign('rows',$rows);
            $this->smarty->assign('list', $list);
//            3、查询用户角色并根据角色分配操作。1为普通，2为全局。
            if ($_SESSION['role'] == 2) {
                $btn='<input title="" type="button" id="new_btn" value="新增" onclick="showNew()">';
                $this->smarty->assign('newBtn',$btn);
            } else {
                $this->smarty->assign('newBtn', '');
            }
//            4、拼接整个页面
            $this->smarty->display('app.header.php');
            $this->smarty->display('list.select.php');
            $this->smarty->display('list.list.php');
            $this->smarty->display('app.footer.php');
        } else {
            $this->smarty->display('loginfailed.php');
        }
    }
//    登出
    public function logout(){
        $_SESSION['isLogin']=false;
        $this->smarty->display('denglu.php');
    }
}