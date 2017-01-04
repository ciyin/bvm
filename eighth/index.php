<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/16
 * Time: 14:43
 */
session_start();
require_once 'controller/action.php';
$a=new Action();
//requireFile:按控制器包含文件和执行方法
function requireFile($controller,$action){
    $file='controller/'.$controller.'.php';
    require_once $file;
    $bvm = new $controller;
    $bvm->$action();
}
//先判断是否已登录
if ($_SESSION['isLogin']){
//    若为真，则包含相应的文件
    requireFile($_REQUEST['controller'],$_REQUEST['action']);
}else{
//    若为假，先判断是否有传用户账号信息
    if ($_REQUEST['username']&&$_REQUEST['password']){
//       如果有用户账号信息，则验证账号，验证成功则设置为已登录状态
        requireFile('login','loginCheck');
    }else{
//        如果没有用户账号信息，则显示登录界面
        $a->smarty->display('denglu.php');
    }
}
echo 'this is a change';