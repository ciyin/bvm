<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><{$title}></title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="bvm_style.css">
</head>
<body>
<div class="header" id="top"><!--【1】-->
    <div class="container"><!--【2】-->
        <div class="row"><!--【3】-->
            <div class="col-xs-10 col-md-10 col-lg-10 float_left"><!--【4】-->
                <ul class="nav nav-pills">
                    <li><a href="index.php?controller=showpage&action=showList">教材列表</a></li>
                </ul>
            </div><!--【4】-->
            <div class="col-xs-2 col-md-2 col-lg-2 float_right account_info"><!--【5】-->
                <div class="float_right"><!--【6】-->
                    <span>用户名：</span>
                    <span><{$user}></span>
                    <span><a href="index.php?controller=login&action=logout">退出</a></span>
                </div><!--【6】-->
            </div><!--【5】-->
        </div><!--【3】-->
    </div><!--【2】-->
</div><!--【1】-->
<div class="container"><!--【7】-->

