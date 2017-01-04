<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/8
 * Time: 17:19
 */
error_reporting(0);//所有的报错信息都不显示
class DataModel{
    public $connect; //存储数据库连接
    public $charset; //存储数据库使用的字符集
    public $rows;//存储执行结果的记录数
//    连接数据库，需传参：数据库服务器地址，用户名，密码，要打开的数据库
    public function __construct($server,$user,$psd,$db){
        $this->connect=mysqli_connect($server,$user,$psd,$db) or die('failed……');
        return $this->connect;
    }
//    设置数据库所使用的字符集
    public function setCharset(){
        $this->charset=mysqli_set_charset($this->connect,'utf8');
        return $this->charset;
    }
//    得到执行结果的记录数
    public function queryRows($result){
        $rows=mysqli_num_rows($result);
        return $rows;
    }
//    得到上一步操作的记录ID
    public function queryID(){
        $queryID=mysqli_insert_id($this->connect);
        return $queryID;
    }
//    插入数据
    public function insert($connect,$array,$table){
        $fields=join(',',array_keys($array));
        $value="'".join("','",array_values($array))."'";
        $sql="INSERT {$table} ({$fields})VALUES({$value})";
        $result=mysqli_query($connect,$sql);
        return $result;
    }
//    检查用户名和密码是否正确
    public function verify($username,$password){
        $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result=mysqli_query($this->connect,$sql);
        $this->rows=$this->queryRows($result);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据条件查询所有教材记录及其最新版本号，并以数组的形式返回：二维索引+关联数组
    public function selectList($and){
        $sql="SELECT a.id,a.book,a.exam_type,a.book_type,a.status,b.version,from_unixtime(b.created_at)as created_at FROM books AS a JOIN versions AS b ON a.id=b.books_id WHERE b.created_at IN (SELECT max(created_at) FROM versions GROUP BY books_id) {$and} ORDER BY b.created_at DESC ";
        $result=mysqli_query($this->connect,$sql);
        $this->rows=$this->queryRows($result);
        $res=mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $res;
    }
//    根据教材id查询该本教材的基本信息，并以数组的形式返回：一维关联数组
    public function selectBasicInfo($id){
        $sql="SELECT id,book,exam_type,book_type,status,contents,using_instruction FROM books WHERE id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据教材id查询该本教材的所有版本号，并以数组的形式返回：二维索引+关联数组
    public function selectVersionNum($id){
        $sql="SELECT id,version FROM versions WHERE books_id='$id' ORDER BY created_at DESC ";
        $result=mysqli_query($this->connect,$sql);
        $this->rows=$this->queryRows($result);
        $res=mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $res;
    }
//    根据教材id查询该本教材的最新版本号，并以数组的形式返回：一维关联数组
    public function selectMaxVersion($id){
        $sql="SELECT id,max(created_at),version FROM versions WHERE books_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据版本id查询该版本的改版信息,并以数组的形式返回：一维关联数组
    public function selectUpdateReason($id){
        $sql="SELECT update_reason FROM versions_update WHERE versions_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据版本id查询版本号
    public function selectVID($id){
        $sql="SELECT version FROM versions WHERE id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据版本id查询该版本的封面信息，并以数组的形式反馈：一维关联数组
    public function selectCovers($id){
        $sql="SELECT id,cover,saved_at FROM covers WHERE versions_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据版本id查询该版本的附件信息,并以数组的形式返回：二维索引+关联数组
    public function selectVersionAttach($id){
        $sql="SELECT a.id, a.attachment,a.saved_at,a.status FROM attachments AS a JOIN attachments_versions AS b ON a.id=b.attachments_id WHERE b.versions_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $res;
    }
//    根据教材id查询该本教材的附件信息,并以数组的形式返回：二维索引+关联数组
    public function selectBookAttach($id){
        $sql="SELECT a.id,a.attachment,a.saved_at,a.status FROM attachments AS a JOIN attachments_books AS b ON a.id=b.attachments_id WHERE b.books_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $res;
    }
//    根据教材id更新教材的使用状态
    public function updateBook($status,$id){
        $sql="UPDATE books SET status='$status' WHERE id='$id'";
        mysqli_query($this->connect,$sql);
    }
//    根据附件id更新附件的使用状态
    public function updateAttach($status,$id){
        $sql="UPDATE attachments SET status='$status' WHERE id='$id'";
        mysqli_query($this->connect,$sql);
    }
//    根据附件Id查找教材id
    public function selectBooksId($id){
        $sql="SELECT books_id FROM attachments_books WHERE attachments_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
//    根据附件ID查找版本id
    public function selectVersionsId($id){
        $sql="SELECT versions_id FROM attachments_versions WHERE attachments_id='$id'";
        $result=mysqli_query($this->connect,$sql);
        $res=mysqli_fetch_assoc($result);
        return $res;
    }
}