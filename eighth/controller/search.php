<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/22
 * Time: 15:26
 */
class Search extends Action {
//    根据条件查询列表，得出查询结果的记录表，替换原来的rows和list,再重新展示list
    public function listSelect($and){
        $list=$this->model->selectList($and);
        $rows=$this->model->rows;
        $this->smarty->assign('rows',$rows);
        $this->smarty->assign('list',$list);
        $this->smarty->display('list.list.php');
    }
//    按考试类型查询
    public function examType(){
//        如果教材类型选择全部或空，则显示所有教材列表，否则根据类型进行搜索
        if ($_REQUEST['select_exam_type']=='全部' || $_REQUEST['select_exam_type']==''){
            $and='';
            $this->listSelect($and);
        }else{
            $and="AND a.exam_type='{$_REQUEST['select_exam_type']}'";
            $this->listSelect($and);
        }
    }
//    按教材类型查询
    public function bookType(){
//        如果教材类型选择全部或者空，则显示所有列表，否则按照教材类型搜索列表
        if ($_REQUEST['select_book_type']=='全部' || $_REQUEST['select_book_type']==''){
            $and='';
            $this->listSelect($and);
        }else{
            $and="AND a.book_type='{$_REQUEST['select_book_type']}'";
            $this->listSelect($and);
        }
    }
//    按关键字查询
    public function keywords(){
        $and="AND a.book LIKE '%{$_REQUEST['search_keywords']}%'";
        $this->listSelect($and);
    }
}