<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$template['title'] = "修改用户名";
?>
<?php
    $isok = true;
    $name['user'] = true;
    $newname['user'] = true;
    $samename['user'] = true;
    if(isset($_POST['submit'])){
        $query = "select * from sfk_member where name='{$_POST['name']}'";
        $querys = "select * from sfk_member where name='{$_POST['newname']}'";
        $result = execute($link,$query);
        $results = execute($link,$querys);
        if(mysqli_num_rows($result)){
            $name['user'] = true;
            $isok = true;
        }else{
            $name['user'] = false;
            $isok = false;
        }
        if(mysqli_num_rows($results)){
            $samename['user'] = false;
            $isok = false;
        }
        if(strlen($_POST['newname'])>32||empty($_POST['newname'])){
            $isok = false;
            $newname['user'] = false;
        }
        if ($isok){
            $_POST = escape($link,$_POST);
            $link=connect();
            $query="update sfk_member set name = '{$_POST['newname']}' where name='{$_POST['name']}'";
            execute($link,$query);
        }
    }
?>
<link rel="stylesheet" type="text/css" href="style/change.css" />
<div class="changepassword">
    <form method="post">
        <div>
            <span>原用户名：</span>
            <input name="name" type="text"><span1>*请输入原用户名</span1>
        </div><br>
        <div>
            <span>新用户名：</span>              
            <input name="newname" type="text"><span1>*请输入新用户名</span1>         
        </div><br><br><br>
        <input type="reset" name="reset" value="重置" /><br><br>
        <input type="submit" name="submit" value="修改" />
    </form>
    <?php
		if (isset($_POST['submit'])){
            if($name['user'] = false){
                echo "原用户名不正确 ";
            }
			if($newname['user'] == false){
                echo "新用户名不符要求";
            }
            if($samename['user'] == false){
                echo "新用户名已被使用";
            }  
        }
	?>
	<?php
		if (isset($_POST['submit'])) {
			if ($isok == true){
                echo "<script>alert('修改成功，新用户名：{$_POST['newname']}');parent.location.href='login.php';</script>";
                
			}
			elseif($isok == false){
				echo " 修改失败";
			}
		}
	?>
</div>       