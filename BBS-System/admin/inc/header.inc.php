<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
    <title><?php echo $template['title'];?></title>
    <script src="js/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/public.css" />
	<link rel="stylesheet" type="text/css" href="style/header.css" />
</head>
<body>
<?php
$link = connect();
$query = "select * from sfk_manage where name='{$_SESSION['manage']['name']}'";
$result = execute($link,$query);
if (mysqli_num_rows($result)!=1){
    header("Location: login.php");
}
?>
<!-- 头部 -->
<div id="top">
	<img src="images/zhku.png" class="images"></a>
    <span class="guanli">管理中心</span></a>
    <span class="youbian">
		<a href="../index.php" style="color:#fff;" target="_blank">网站首页</a>&nbsp;|&nbsp;管理员： 
		<?php echo $_SESSION['manage']['name'];?> 
		<a href="login_out.php">[注销]</a>
	</span>
</div>
<!-- 左边导航栏 -->
<div class="lefts">
	<div class="nav-list">
		<div class="nav-tit" id="personal">
			<img src="images/personal-msg.png" style="height: 28px" alt="">
			<span>管理员管理</span>
		</div>
			<div class="personal-list" id="personal-child">
				<ul>
					<li><a href="manage.php" target="main">管理员列表</a></li>
					<li><a href="manage_add.php" target="main">添加管理员</a></li>
				</ul>
			</div>
			<div class="nav-tit" id="personal1">
				<img src="images/archives-msg.png" alt="">
				<span>内容管理</span>
            </div>
            <div class="personal-list" id="personal-child1">
				<ul>
					<li><a href="father_module.php" target="main">父板块列表</a></li>
					<li><a href="father_module_add.php" target="main">添加父板块</a></li>
                    <li><a href="son_module.php" target="main">子板块列表</a></li>
                    <li><a href="son_module_add.php" target="main">添加子板块</a></li>
				</ul>
			</div>
			<div class="nav-tit">
				<a href="postmanage.php" target="main">
					<img src="images/job-change.png" alt="">
					<span>帖子管理</span>
				</a>
			</div>
            <div class="nav-tit" id="personal2">
				<img src="images/personal-msg.png" style="height: 28px" alt="">
				<span>用户管理</span>
            </div>
            <div class="personal-list" id="personal-child2">
				<ul>
					<li><a href="users_list.php" target="main">用户列表</a></li>
				</ul>
			</div>
			<div class="nav-tit">
				<a href="feedback.php" target="main">
					<img src="images/job-change.png" alt="">
					<span>反馈管理</span>
				</a>
			</div>
            <div class="nav-tit">
                <a href="changepassword.php">
					<img src="images/modify-password.png" alt="">
					<span>修改密码</span>
				</a>
            </div>
	</div>
</div>
<!-- 导航栏下拉 -->
	<script>
		$(document).ready(function(){
			$('#personal').on('click',function(){
				$('#personal-child').fadeToggle(100);
			});
			let aLi = $('#personal-child li');
			aLi.on('click',function(){
				$(this).addClass('active').siblings('li').removeClass('active');
			})
			
		});
		$(document).ready(function(){
			$('#personal1').on('click',function(){
				$('#personal-child1').fadeToggle(100);
			});
			let aLi = $('#personal-child1 li');
			aLi.on('click',function(){
				$(this).addClass('active').siblings('li').removeClass('active');
			})
		});
		$(document).ready(function(){
			$('#personal2').on('click',function(){
				$('#personal-child2').fadeToggle(50);
			});
			let aLi = $('#personal-child2 li');
			aLi.on('click',function(){
				$(this).addClass('active').siblings('li').removeClass('active');
			})
		});
	</script>
</boby>
</html>