<?php 
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';

$link=connect();
$login['success'] = null;
if(isset($_POST['submit'])){
	$_POST = escape($link,$_POST);
	$query = "select * from sfk_manage where name='{$_POST['name']}' and pw='{$_POST['pw']}'";
	$result = execute($link, $query);
	if(mysqli_num_rows($result)==1){
		$data=mysqli_fetch_assoc($result);
		$_SESSION['manage']['name']=$data['name'];
		$_SESSION['manage']['pw']=sha1($data['pw']);
		$_SESSION['manage']['id']=$data['id'];
		$_SESSION['manage']['level']=$data['level'];
		$login['success'] ='yes';
	}else if(empty($_POST['name']) || empty($_POST['pw'])){
        $login['success'] = 'no';
	}else{
        $login['success'] = 'no';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员登录</title>
    <style>
        *{margin: 0px;padding: 0px;}
        body{
            background-color: aqua;
        }
        #div{
            width:400px;
            height:480px;
            background:#B1FEF9;
            margin:0 auto;
            margin-top:150px;
            border-radius:30px;
        }
        #cnt{
            text-align: center;
            padding-top:50px;
            font-size: 27px;
            font-family: "隶书";
        }
        input{
            width: 160px;
            font-size: 20px;
            padding-left: 5px;
            border-radius: 5px;
        }
        input[type="reset"]{
            margin-top:50px;
            font-family:"隶书";
            width: 230px;
            text-align: center;
            margin-bottom:15px;
            background-color:#0c6cac;
            border-radius:10px;
            font-size: 27px;
        }
        input[type="submit"]{
            font-family:"隶书";
            width: 230px;
            text-align: center;
            background-color:#0c6cac;
            border-radius:10px;
            font-size: 27px;
        }
    </style>
</head>
<body>
    <div id="div">
        <h1 style="padding-top: 50px;text-align: center;">欢迎登陆校园论坛</h1>
        <h1 style="padding-top: 10px;text-align: center;">后台管理系统</h1>
        <div id="cnt">
        <form method="post">
            用户名：<input type="text" placeholder="请输入用户名" name="name">
            <br><br>
            密&emsp;码：<input type="password" placeholder="请输入密码" name="pw">
            <input type="reset" name="reset" value="重置" />
            <input type="submit" name="submit" value="登录" />
        </form>
        <p>
            <?php
            if (isset($login['success'])){
                if ($login['success'] == 'yes'){
                    header("Location: father_module.php");
                }
                else if ($login['success'] == 'no'){
                    echo "<script>alert('用户名或密码不正确,或输入不完整，登陆失败')</script>";
                }
            }
            ?>
        </p>
        </div>
    </div>
</body>
</html>
