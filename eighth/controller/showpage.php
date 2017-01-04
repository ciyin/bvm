<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/22
 * Time: 16:12
 */
class ShowPage extends Action {
//    显示列表页
    public function showList(){
        $this->smarty->assign('title', '教材列表');
        $this->smarty->assign('user', $_SESSION['user']);
        $and='';
        $list = $this->model->selectList($and);
        $rows=$this->model->rows;
        $this->smarty->assign('rows',$rows);
        $this->smarty->assign('list', $list);
        if ($_SESSION['role'] == 2) {
            $btn='<input title="" type="button" id="new_btn" value="新增" onclick="showNew()">';
            $this->smarty->assign('newBtn',$btn);
        } else {
            $this->smarty->assign('newBtn', '');
        }
        $this->smarty->display('app.header.php');
        $this->smarty->display('list.select.php');
        $this->smarty->display('list.list.php');
        $this->smarty->display('app.footer.php');
    }
//    显示详情页
    public function showDetails(){
//        1、更换页面的标题
        $this->smarty->assign('title', '教材详情');
//        2、根据用户身份分配操作：1为普通，2为全局
        $this->smarty->assign('user',$_SESSION['user']);
//        3、根据教材id查询该本教材的基本信息
        $bookInfo=$this->model->selectBasicInfo($_REQUEST['book']);
        $this->smarty->assign('bookInfo',$bookInfo);
//        如果该本教材已停用，则不显示改版和停用按钮
        if ($bookInfo['status']=='停用'){
            $this->smarty->assign('btnOfBooks', '');
        }else{
//            否则，如果该角色有操作权限，则显示按钮
            if ($_SESSION['role'] == 2){
                $btn=<<<BTN
<button type="button" class="float_right btn_u" onclick="discardBook()">停用</button>
<button type="button" class="float_right btn_s" onclick="showUpdateForm()">改版</button>
BTN;
                $this->smarty->assign('btnOfBooks',$btn);
                $this->smarty->assign('role',true);
                $btn2='<button type="button" class="btn_u" onclick="upload()">添加附件</button>';
                $this->smarty->assign('addAttach',$btn2);
            }
        }
//        4、根据教材Id查询该本教材的所有版本号
        $versionNum=$this->model->selectVersionNum($_REQUEST['book']);
        $this->smarty->assign('rows',$this->model->rows);
        $this->smarty->assign('versionNum',$versionNum);
//        5、根据教材Id查询该本教材的最新版本号
        $maxVersion=$this->model->selectMaxVersion($_REQUEST['book']);
        $this->smarty->assign('maxVersion',$maxVersion);
//        6、在没有点击其他版本号前，默认显示最新版本号的改版信息
        $this->smarty->assign('vn',$maxVersion['version']);
        $updateReason=$this->model->selectUpdateReason($maxVersion['id']);
        if ($updateReason){
            $this->smarty->assign('reason',$updateReason['update_reason']);
        }else{
            $this->smarty->assign('reason','未改版过');
        }
//        7、在没有点击其他版本号前，默认显示最新版本号的附件信息
        $attachments=$this->model->selectVersionAttach($maxVersion['id']);
        $this->smarty->assign('attachments',$attachments);
        $this->smarty->assign('vid',$maxVersion['id']);
        if ($attachments){
            $this->smarty->assign('attach','');
        }else{
            $this->smarty->assign('attach','<span>没有附件</span>');
        }
//        8、显示教材封面
        $cover=$this->model->selectCovers($maxVersion['id']);
        $this->smarty->assign('cover',$cover['saved_at']);
//        9、拼接页面
        $this->smarty->display('app.header.php');
        $this->smarty->display('details.bookinfo.1.php');
        $this->smarty->display('details.bookinfo.2.php');
        $this->smarty->display('details.versioninfo.1.php');
        $this->smarty->display('details.versioninfo.2.php');
        $this->smarty->display('details.versioninfo.3.php');
        $this->smarty->display('details.versioninfo.4.php');
        $this->smarty->display('app.footer.php');
    }
}