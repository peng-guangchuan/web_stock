<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$template['title']='修改密码';
?>
<?php
    $isok = true;
    $namepw['user'] = true;
    $newpassword['user'] = true;
    $enterpassword['user'] = true;
    $same['user'] = true;
    if(isset($_POST['submit'])){
        $query = "select * from sfk_member where name='{$_POST['name']}' and pw='{$_POST['pw']}'";
        $result = execute($link,$query);
        if (mysqli_num_rows($result)){
            $namepw['user'] = true;
            $isok = true;
        }else{
            $namepw['user'] = false;
            $isok = false;
        }
        if(strlen($_POST['newpassword'])<6||empty($_POST['newpassword'])){
            $isok = false;
            $newpassword['user'] = false;
        }
        if(strlen($_POST['enterpassword'])<6||empty($_POST['enterpassword'])){
            $isok = false;
            $enterpassword['user'] = false;
        }
        if($_POST['newpassword'] != $_POST['enterpassword']){
            $isok = false;
            $same['user'] = false;
        }
        if ($isok){
            $_POST = escape($link,$_POST);
            $link=connect();
            $query="update sfk_member set pw = '{$_POST['enterpassword']}' where name='{$_POST['name']}'";
            execute($link,$query);
        }
    }
?>
<link rel="stylesheet" type="text/css" href="style/change.css" />
<div class="changepassword">
    <form method="post">
        <div>
            <span>用&nbsp;户&nbsp;名：</span>
            <input name="name" type="text"><span1>*请输入用户名</span1>
        </div><br>
        <div>
            <span>密&emsp;&emsp;码：</span>
            <input name="pw" type="text"><span1>*请输入原始密码</span1>
        </div><br>
        <div>
            <span>新&nbsp;密&nbsp;码：</span>              
            <input name="newpassword" type="password"><span1>*密码不得少于六位</span1>         
        </div><br>
        <div>
            <span>确认密码：</span>
            <input name="enterpassword" type="password">
        </div><br><br><br>
        <input type="reset" name="reset" value="重置" /><br><br>
        <input type="submit" name="submit" value="修改密码" />
    </form>
    <?php
		if (isset($_POST['submit'])){
            if($namepw['user'] = false){
                echo "原密码和原密码不正确 ";
            }
			if($newpassword['user'] == false)
				echo "新密码不符要求 ";
			if ($enterpassword['user'] == false){
				echo "确认密码不符要求  ";
            }
            if($same['user'] == false){
                echo "新密码与正确密码不一致 ";
            }
		}
	?>
	<?php
		if (isset($_POST['submit'])) {
			if ($isok == true){
				echo "<script>alert('修改成功，用户名：{$_POST['name']}');parent.location.href='login.php';</script>";
			}
			elseif($isok == false){
				echo " 修改失败";
			}
		}
	?>
</div>
       