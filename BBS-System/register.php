<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link = connect();
$member_id = is_login($link);
//因为有三种状态，分别由true，false，以及null代替
?>

<?php
$isok = true;
$name['user'] = true;
$pw['user'] = true;
$confirm_pw['user'] = true;
$same_name['user'] = true;
if(isset($_POST['submit'])){
    $query = "select * from sfk_member where name='{$_POST['name']}'";
    $result = execute($link,$query);
    if (mysqli_num_rows($result)){
        $same_name['user'] = false;
        $isok = false;
    }
    if(strlen($_POST['name'])>32||empty($_POST['name'])){
        $isok = false;
        $name['user'] = false;
    }
    if(strlen($_POST['pw'])<6||empty($_POST['pw'])){
        $isok = false;
        $pw['user'] = false;
    }
    if(strlen($_POST['confirm_pw'])<6||empty($_POST['confirm_pw'])||$_POST['pw']!=$_POST['confirm_pw']){
        $isok = false;
        $confirm_pw['user'] = false;
    }
    if ($isok){
        $_POST = escape($link,$_POST);
//        本质数组，将数组值进行转义
        $link=connect();
        $query="insert into sfk_member(name,pw,register_time) values('{$_POST['name']}','{$_POST['pw']}',now())";
        execute($link,$query);
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">  
		<title>用户注册</title>
		<link rel="stylesheet" type="text/css" href="style/registers.css"/>
	</head>
	<body>
		<div class="main ">
			<h1 style="padding-top:50px;text-align: center;">欢迎注册账号</h1>
				<div class="logo">
					<img src="style/zhku.png" width="180px" height="180px">
				</div>
				<form method="post">
					<div class="bottom">
						<div>
							<span>用&nbsp;户&nbsp;号：</span>
							<input type="text" name="name">&emsp;<span1>*非空且小于三十二</span1>
						</div><br>
						<div>
							<span>密&emsp;&emsp;码：</span>
							<input type="password" name="pw">&emsp;<span1>*密码不得少于六位</span1>
						</div><br>
						<div>
							<span>确认密码：</span>
							<input type="password" name="confirm_pw">&emsp;<span1>*请输入与上面一致</span1>
						</div><br>
					</div><br>
                        <input type="reset" name="reset" class="btn" value="重置">
						<input type="submit" name="submit" class="btn" value="注册">
						<?php
							if (isset($_POST['submit'])){
								if($name['user'] == false)
									echo "用户名不满足要求,";
								if($pw['user'] == false)
									echo "密码不得少于6位,";
								if($confirm_pw['user'] == false)
									echo "确认密码错误.";
								if ($same_name['user'] == false){
									echo "用户名不能重复";
								}
							}
						?>
						<?php
							if (isset($_POST['submit'])) {
								if ($isok == true){
									echo "<script>alert('注册成功，用户名：{$_POST['name']}');parent.location.href='login.php';</script>";
								}
								elseif($isok == false){
									echo "注册失败";
								}
							}
						?>
				</form>
		</div>
	</boby>
</html>
				