<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/22
 * Time: 15:57
 */
class Form extends Action
{
//   uploadAttach():上传附件，传参：版本Id,教材Id
    public function uploadAttach($versions_id,$books_id){
        $count = count($_FILES['attachment']['tmp_name']);//统计上传的文件数量
        $tmp_name = $_FILES['attachment']['tmp_name'];//文件的临时名称，$tmp_name：一维索引数组
        $name = $_FILES['attachment']['name'];//文件名，$name：一维索引数组
        if (!$tmp_name[0] == '') { //如果有上传文件
            for ($i = 0; $i < $count; $i++) { //执行文件插入操作
                $attachments['attachment'] = base64_encode($name[$i]); //先将文件名转码
                move_uploaded_file($tmp_name[$i], "attachments/" . $attachments['attachment']); //将文件保存到attachments中
                $attachments['saved_at'] = "attachments/" . $attachments['attachment']; //文件的保存地址
                $attachments['status'] = '使用中';//文件的使用状态
                $attachments['created_by'] = $_SESSION['user_id'];//上传人
                $attachments['created_at'] = time();//上传时间
                $this->model->insert($this->model->connect, $attachments, 'attachments');//插入附件表
                $attachments_id = $this->model->queryID();//附件id
                $attachments_versions['attachments_id'] = $attachments_id;
                $attachments_versions['versions_id'] = $versions_id;//传参：版本id
                $this->model->insert($this->model->connect, $attachments_versions, 'attachments_versions');//插入附件版本关联表
                $attachments_books['attachments_id'] = $attachments_id;
                $attachments_books['books_id'] = $books_id; //传参：教材id
                $this->model->insert($this->model->connect, $attachments_books, 'attachments_books');//插入附件教材关联表
            }//for end
        }//if end
    }
//    uploadCover():上传封面，传参：版本id
    public function uploadCover($versions_id){
        if (file_exists($_FILES["cover"]["tmp_name"])) { //如果有上传封面
            $covers['cover'] = base64_encode($_FILES['cover']['name']); //先将封面名称转码
            move_uploaded_file($_FILES["cover"]["tmp_name"], "covers/" . $covers['cover']);//将封面保存到covers中
            $covers['saved_at'] = "covers/" . $covers['cover'];//封面的保存地址
            $covers['versions_id'] = $versions_id;//传参：版本id
            $covers['created_by'] = $_SESSION['user_id'];//上传人
            $covers['created_at'] = time();//上传时间
            $this->model->insert($this->model->connect, $covers, 'covers');//插入封面表
        }//if end
    }
//    显示新增表单
    public function showNew(){
        $this->smarty->display('form.new.php');
    }
//    提交新增表单
    public function submitNewForm()
    {
//        如果教材名字和版本号都有值，则执行数据表操作
        if (!$_REQUEST['book'] == '' && !$_REQUEST['version'] == '') {
//            1、插入教材记录books
            $books['book'] = $_REQUEST['book'];
            $books['exam_type'] = implode('/', $_REQUEST['exam_type']);
            $books['book_type'] = $_REQUEST['book_type'];
            $books['contents'] = $_REQUEST['contents'];
            $books['using_instruction'] = $_REQUEST['using_instruction'];
            $books['status'] = '使用中';
            $books['created_by'] = $_SESSION['user_id'];
            $books['created_at'] = time();
            $this->model->insert($this->model->connect, $books, 'books');
            $books_id = $this->model->queryID();
//            2、插入版本记录versions
            $versions['version'] = $_REQUEST['version'];
            $versions['books_id'] = $books_id;
            $versions['created_by'] = $_SESSION['user_id'];
            $versions['created_at'] = time();
            $this->model->insert($this->model->connect, $versions, 'versions');
            $versions_id = $this->model->queryID();
//            3、插入操作记录operations
            $operations['books_id'] = $books_id;
            $operations['type'] = '新增';
            $operations['operation'] = $operations['type'] . $books['book'];
            $operations['created_by'] = $_SESSION['user_id'];
            $operations['created_at'] = time();
            $this->model->insert($this->model->connect, $operations, 'operations');
//            4、检查是否有上传封面，若有，则插入封面记录covers
            $this->uploadCover($versions_id);
//            5、检查是否有上传附件，若有，则插入附件记录attachments,attachments_versions,attachment_books
            $this->uploadAttach($versions_id,$books_id);
//            6、重新查询教材列表并显示
            $and = '';
            $list = $this->model->selectList($and);
            $rows = $this->model->rows;
            $this->smarty->assign('rows', $rows);
            $this->smarty->assign('list', $list);
            $this->smarty->display('list.list.php');
        } else {
            echo "教材名字或版本号不能为空！";
        }
    }
//    显示改版表单
    public function showUpdate(){
        $result=$this->model->selectBasicInfo($_REQUEST['book']);//根据教材id查询该本教材的基本信息
        $this->smarty->assign('bookname',$result['book']);
        $this->smarty->assign('book_id',$result['id']);
        $this->smarty->display('form.update.php');
    }
//    提交改版表单
    public function submitUpdate(){
//        1、插入版本记录表
        $versions['version'] = $_REQUEST['version'];
        $versions['books_id'] = $_REQUEST['book'];
        $versions['created_by'] = $_SESSION['user_id'];
        $versions['created_at'] = time();
        $this->model->insert($this->model->connect, $versions, 'versions');
        $versions_id = $this->model->queryID();
//        2、插入版本变更表
        $update['versions_id']=$versions_id;
        $update['update_type']='改版';
        $update['update_reason']=$_REQUEST['update_reason'];
        $update['created_by'] = $_SESSION['user_id'];
        $update['created_at'] = time();
        $this->model->insert($this->model->connect, $update, 'versions_update');
//        3、插入教材封面
        $this->uploadCover($versions_id);
//        4、插入附件
        $this->uploadAttach($versions_id,$_REQUEST['book']);
//        5、检查是否有关联附件
        $a=$_REQUEST['attach'];
        if ($a){
            $counts=count($a);
            for ($i=0;$i<$counts;$i++){
                $attach['attachments_id']=$a[$i];
                $attach['versions_id']=$versions_id;
                $this->model->insert($this->model->connect, $attach, 'attachments_versions');
            }
        }
//        6、重新搜索教材的版本信息
//        6.1、根据教材Id查询该本教材的所有版本号
        $versionNum=$this->model->selectVersionNum($_REQUEST['book']);
        $this->smarty->assign('rows',$this->model->rows);
        $this->smarty->assign('versionNum',$versionNum);
//        6.2、根据教材Id查询该本教材的最新版本号
        $maxVersion=$this->model->selectMaxVersion($_REQUEST['book']);
        $this->smarty->assign('maxVersion',$maxVersion);
//        6.3、在没有点击其他版本号前，默认显示最新版本号的改版信息
        $updateReason=$this->model->selectUpdateReason($maxVersion['id']);
        if ($updateReason){
            $this->smarty->assign('reason',$updateReason['update_reason']);
        }else{
            $this->smarty->assign('reason','未改版过');
        }
//        6.4、在没有点击其他版本号前，默认显示最新版本号的附件信息
        $attachments=$this->model->selectVersionAttach($maxVersion['id']);
        $this->smarty->assign('attachments',$attachments);
        if ($attachments){
            $this->smarty->assign('attach','');
        }else{
            $this->smarty->assign('attach','<dd>没有附件</dd>');
        }
//        6.5、显示教材封面
        $cover=$this->model->selectCovers($maxVersion['id']);
        $this->smarty->assign('cover',$cover['saved_at']);
//        7、拼接页面
        $this->smarty->display('versions.php');
        $this->smarty->display('versioninfo.php');
    }
//    停用教材
    public function discardBook(){
        $this->model->updateBook('停用',$_REQUEST['book']);//根据教材id更新教材的使用状态
        $operation['books_id']=$_REQUEST['book'];
        $operation['type']='停用教材';
        $operation['operation']='停用教材'.$_REQUEST['book'];
        $operation['created_by']=$_SESSION['user_id'];
        $operation['created_at']=time();
        $this->model->insert($this->model->connect,$operation,'operations');//插入操作记录
        $bookInfo=$this->model->selectBasicInfo($_REQUEST['book']);//根据教材id查询该本教材的基本信息
        $this->smarty->assign('bookInfo',$bookInfo);
        $this->smarty->assign('btnOfBooks',''); //停用后，不再显示改版及停用按钮
        $this->smarty->display('details.bookinfo.2.php');//更新教材基本信息
    }
//    停用附件
    public function discardAttachment(){
        $this->model->updateAttach('停用',$_REQUEST['attach']);//根据附件id更新附件的使用状态
        $result=$this->model->selectBooksId($_REQUEST['attach']);//根据附件Id查找教材id
        $operation['books_id']=$result['books_id'];
        $operation['type']='停用附件';
        $operation['operation']='停用附件'.$_REQUEST['attach'];
        $operation['created_by']=$_SESSION['user_id'];
        $operation['created_at']=time();
        $this->model->insert($this->model->connect,$operation,'operations');//插入操作记录
        $result=$this->model->selectVersionsId($_REQUEST['attach']);//根据附件ID查找版本id
        $versions_id=$result['versions_id'];
        $res=$this->model->selectVersionAttach($versions_id);//根据版本id查询该版本的附件信息
        $this->smarty->assign('attachments',$res);
        $this->smarty->assign('role',true);
        $this->smarty->display('details.versioninfo.3.php');//更新附件列表
    }
//    显示添加附件的表单
    public function showUpload(){
        $version_id=$_REQUEST['vID'];
        $result=$this->model->selectVID($version_id);
        $this->smarty->assign('version',$result['version']);
        $this->smarty->assign('v_id',$version_id);
        $this->smarty->display('form.upload.php');
    }

//    在添加附件表单中，点击从资料库中选择附件，显示该本教材的所有附件
    public function selectAttachment(){
        $result=$this->model->selectBookAttach($_REQUEST['book']);//根据教材id查询该本教材的附件信息
        $this->smarty->assign('attach',$result);
        $this->smarty->display('form.update.selectAttach.php');
    }
//    提交添加附件的表单
    public function submitUpload()
    {
        $this->uploadAttach($_REQUEST['version'],$_REQUEST['book']);
        $attachs=$this->model->selectVersionAttach($_REQUEST['version']);
        $this->smarty->assign('attachments',$attachs);
        $this->smarty->assign('role',true);
        if ($attachs){
            $this->smarty->assign('attach','');
        }else{
            $this->smarty->assign('attach','<span>没有附件</span>');
        }
        $this->smarty->display('details.versioninfo.3.php');
    }
}

