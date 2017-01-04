<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2017/1/1
 * Time: 14:42
 */
class ShowVersionInfo extends Action {
    public function showInfo(){
        $result=$this->model->selectVID($_REQUEST['v']);
        $this->smarty->assign('vn',$result['version']);
//        1、显示该版本的改版信息
        $updateReason=$this->model->selectUpdateReason($_REQUEST['v']);
        if ($updateReason){
            $this->smarty->assign('reason',$updateReason['update_reason']);
        }else{
            $this->smarty->assign('reason','未改版过');
        }
//        2、显示该版本的附件信息
        $attachments=$this->model->selectVersionAttach($_REQUEST['v']);
        $this->smarty->assign('attachments',$attachments);
        $this->smarty->assign('vid',$_REQUEST['v']);
        if ($attachments){
            $this->smarty->assign('attach','');
        }else{
            $this->smarty->assign('attach','<span>没有附件</span>');
        }
//        3、显示该版本的封面
        $cover=$this->model->selectCovers($_REQUEST['v']);
        $this->smarty->assign('cover',$cover['saved_at']);
//        4、拼接页面
        $this->smarty->display('details.versioninfo.2.php');
        $this->smarty->display('details.versioninfo.3.php');
        $this->smarty->display('details.versioninfo.4.php');
    }
}