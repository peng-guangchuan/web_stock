<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link = connect();
$login_info['success'] = null;
$member_id=is_login($link);
?>

<?php
if (isset($_POST['submit'])){
    $query = "select * from sfk_member where name='{$_POST['name']}' and pw='{$_POST['pw']}'";
    $result = execute($link,$query);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result)==1){
        $login_info['success'] = 'yes';
    }else{
        $login_info['success'] = 'no';
    }
    if(empty($_POST['name']) || empty($_POST['pw'])){
        $login_info['success'] = 'no';
    }
    if($login_info['success']=='yes'){
        setcookie('sfk[name]',$_POST['name']);
        setcookie('sfk[pw]',$_POST['pw']);
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">  
        <title>用户登录</title>
        <link rel="stylesheet" type="text/css" href="style/login.css"/>
    </head>
	<body>
		<div class="main ">
				<div class="logo">
					<img src="style/zhku.png" width="220px" height="220px">
				</div>
					<form method="post">
						<div class="login-box">
							<div class="name">
								<input type="text" placeholder="用户名" name="name" >
							</div>
							<div class="pwd">
								<input type="password" placeholder="密码" name="pw" >
							</div>
                        </div><br>
                        <input type="reset" name="reset" class="btn" value="重置">
                        <input type="submit" name="submit" class="btn" value="登录">
                        <?php
                            if (isset($login_info['success'])){
                                if ($login_info['success']=='yes'){
                                    header("Location: index.php");
                                }
                                elseif ($login_info['success']=='no'){
                                    echo "<script>alert('用户名或密码不正确,或输入不完整，登陆失败')</script>";
                                }
                            }
                        ?>
                    </form>
                    <div class="register">
						<a href="register.php" class="register-new">注册账号</a>
					</div>
				</div>
            </div>
    </body>
</html>