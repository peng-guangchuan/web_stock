<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template['title']='管理员列表页';
?>
<?php
$delete['success'] = null;
	if (isset($_GET['name'])){
		$query = "delete from sfk_manage where name='{$_GET['name']}'"; // 字符整体加单引号
		$result = execute($link,$query);
		if (mysqli_affected_rows($link)==1){
			$delete['success'] ='yes';
		}
		else{
			$delete['success'] = 'no';
		}
	}
?>
<?php include 'inc/header.inc.php'?>
<div id="right">
<div class="title">管理员列表</div>
<link rel="stylesheet" type="text/css" href="style/user_list.css" />
	<div class="user_list">
		<form method="post">
			<table>
				<tr>
					<th>名称</th>	 	 	
					<th>创建日期</th>
					<th>操作</th>
				</tr> 
				<?php 
					$query="select * from sfk_manage";
					$result=execute($link,$query);
					while ($data = mysqli_fetch_assoc($result)){
				?>
				<tr>
					<td><?php echo $data['name']?></td>
					<td><?php echo $data['create_time']?></td>
					<td>&nbsp;&nbsp;<a href="manage.php?name=<?php echo $data['name']?>">[删除]</a></td>
				</tr>
				<?php }?>
			</table>
			<p>
				<?php
					if (isset($delete['success'])){
						if ($delete['success']=='yes'){
							echo "删除成功";
						}
						if ($delete['success']=='no'){
							echo "删除失败";
						}
					}
				?>
			</p>
		</form>
	</div>
</div>
