<?php
$server='localhost';
$username='root';
$password='root';
$database='ciyin';
$connect=mysqli_connect($server,$username,$password,$database) or die('fail……');
mysqli_set_charset($connect,'utf8');

$create_roles="CREATE TABLE IF NOT EXISTS roles(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
role VARCHAR(30) NOT NULL UNIQUE COMMENT '角色：校区、教材'
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_roles);

$create_users="CREATE TABLE IF NOT EXISTS users(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
user VARCHAR(30) NOT NULL COMMENT '姓名',
username VARCHAR(30) NOT NULL COMMENT '用户名',
password VARCHAR(50) NOT NULL COMMENT '密码',
roles_id INT NOT NULL COMMENT '角色',
status VARCHAR(10) NOT NULL COMMENT '账号状态：使用中、停用',
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_users);

$create_books="CREATE TABLE IF NOT EXISTS books(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
book VARCHAR(50) NOT NULL UNIQUE COMMENT '教材名称:唯一',
exam_type VARCHAR(20) NOT NULL COMMENT '教材所属科目',
book_type VARCHAR(20) NOT NULL COMMENT '教材类型：课本、词表、模考卷',
contents VARCHAR(255) NOT NULL COMMENT '教材内容',
using_instruction VARCHAR(255) NOT NULL COMMENT '使用说明',
status VARCHAR(20) NOT NULL COMMENT '使用状态：使用中、停用',
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_books);

$create_versions="CREATE TABLE IF NOT EXISTS versions(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
version VARCHAR(30) NOT NULL COMMENT '版本号',
books_id INT NOT NULL COMMENT '教材ID',
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_versions);

$create_versions_update="CREATE TABLE IF NOT EXISTS versions_update(
id INT AUTO_INCREMENT NOT NULL  PRIMARY KEY ,
versions_id INT NOT NULL ,
update_reason VARCHAR(255) NOT NULL ,
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_versions_update);

$create_attachments="CREATE TABLE IF NOT EXISTS attachments(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
attachment VARCHAR(255) NOT NULL COMMENT '附件名称',
saved_at VARCHAR(255) NOT NULL COMMENT '附件存储位置',
status VARCHAR(10) NOT NULL COMMENT '附件使用状态：使用中、停用',
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_attachments);

$create_attachments_versions="CREATE TABLE IF NOT EXISTS attachments_versions(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
attachments_id INT NOT NULL ,
versions_id INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_attachments_versions);

$create_attachments_books="CREATE TABLE IF NOT EXISTS attachments_books(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
attachments_id INT NOT NULL ,
books_id INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_attachments_books);

$create_operations="CREATE TABLE IF NOT EXISTS operations(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
books_id INT NOT NULL ,
type VARCHAR(50) NOT NULL COMMENT '操作类型',
operation VARCHAR(255) NOT NULL COMMENT '操作内容',
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_operations);

$create_covers="CREATE TABLE IF NOT EXISTS covers(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
cover VARCHAR(255) NOT NULL ,
saved_at VARCHAR(255) NOT NULL ,
versions_id INT NOT NULL ,
created_by INT NOT NULL ,
created_at INT NOT NULL 
)ENGINE = InnoDB CHARSET = UTF8";
mysqli_query($connect,$create_covers);

$sql="ALTER TABLE versions_update DROP update_type";
mysqli_query($connect,$sql);
