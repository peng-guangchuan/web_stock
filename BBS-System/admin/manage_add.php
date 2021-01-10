<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template['title']='管理员添加页';
$template['css']='style/public.css';
?>
<?php
$is_login['success'] = null;
    if(isset($_POST['submit'])){
        $query="insert into sfk_manage(name,pw,create_time) values('{$_POST['name']}',{$_POST['pw']},now())";
        execute($link,$query);
        if(mysqli_affected_rows($link)==1){
            $is_login['success'] = 'yes';
        }else{
            echo "添加失败";
            exit();
        }
    }

?>
<?php include 'inc/header.inc.php'?>
<link rel="stylesheet" type="text/css" href="style/changepassword.css"/>
<div id = "right">
    <div class="title">添加管理员</div>
    <form method="post">
        <div class="changepassword">
            <div>
                <span>管理员名称：</span>
                <input name="name" type="text">
            </div><br>
            <div>
                <span>密&emsp;&emsp;&emsp;码：</span>              
                <input name="pw" type="password"><span1>*密码不得少于六位</span1>         
            </div><br><br><br>
            <input type="reset" name="reset" value="重置" /><br><br>
            <input type="submit" name="submit" value="添加" />
        </div>
	</form>
    <p> <?php if (isset($is_login['success'])){
        if ($is_login['success']='yes')
            echo "添加成功";
        else{
            echo "添加失败";
        }
		}?></p>
	</div>
</div>
