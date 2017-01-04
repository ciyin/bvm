<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <style>
        body{font-family: "Microsoft YaHei";padding-top: 10%;}
        h2{margin: 0;line-height: 60px;color: white}
        table{width: 320px}
        tr{height: 40px;border: solid 1px lightgrey}
        .input{height: 40px;width: 320px}
        button{height: 25px;width: 50px;font-family: "Microsoft YaHei";}
        #logo{height:60px;width: 330px;text-align: center}
        #btn{text-align: center;}
        #center{width: 330px; background-color: rgb(66,138,201);margin: 0 auto;border-radius: 5px;}
    </style>
</head>
<body>
    <div id="center">
        <div id="logo">
            <h2>沃邦教材版本管理系统</h2>
        </div>
        <div id="login">
            <form action="../index.php?action=register" method="post">
                <table>
                    <tr><td><input type="text" title="" placeholder="请输入姓名" name="user" class="input"></td></tr>
                    <tr><td><input type="text" title="" placeholder="请输入用户名" name="username" class="input"></td></tr>
                    <tr><td><input type="password" title="" placeholder="请输入密码" name="password" class="input"></td></tr>
                    <tr><td>角色:<input name="role" type="radio" value="1">普通<input name="role" type="radio" value="2">全局</td></tr>
                    <tr><td id="btn"><button type="submit">注册</button></td></tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>