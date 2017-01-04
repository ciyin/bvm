<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/21
 * Time: 20:28
 */
class Register extends Action {
    function action(){
        $created_by='1';
        $created_at=time();
        $value="'{$_POST['user']}','{$_POST['username']}','{$_POST['password']}','{$_POST['role']}','使用中','$created_by','$created_at'";
        $this->model->insertUser($value);
        echo 'success~';
    }
}