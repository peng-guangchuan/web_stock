<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link=connect();
$template['title']="父板块页面";
?>
<?php
//当sort设置为空时，isset返回false
//1、定义在函数外部的就是全局变量，它的作用域从定义处一直到文件结尾。
//2、函数内定义的变量就是局部变量，它的作用域为函数定义范围内。
//var_dump(isset($sort));这个返回true，所以使用要添加键
$sort['error'] = null;
if (isset($_POST['submit'])) {
    foreach ($_POST['sort'] as $key=>$val){
        if (!is_numeric($val)){
            $sort['error'] = "yes";
        }
        $query[] = "update sfk_father_module set sort={$val} where id='{$key}'";
    }
    if ($sort['error']==null){
        execute_multi($link,$query,$error);
        $sort['error'] = 'no';
    }
}
?>

<?php include 'inc/header.inc.php'?>
<div id = "right">
	<div class="title">父版块列表</div>
    <form action="" method="post">
        <table class="list">
            <tr>
                <th>排序</th>
                <th>版块名称</th>
                <th>操作</th>
            </tr>
            <?php
            $query = "select * from sfk_father_module";
            $result = execute($link,$query);
            while($data = mysqli_fetch_assoc($result)){
                $html = <<<A
            <tr>
				<td><input class="sort" type="text" name="sort[{$data['id']}]" value="{$data['sort']}"/></td>
				<td>{$data['module_name']}[id:{$data['id']}]</td>
				<td><a href="father_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="father_module_delete.php?id={$data['id']}">[删除]</a></td>
			</tr>
A;
                echo $html;
            }
            ?>

        </table>
        <input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="排序" />
        <p>
            <?php
                if (isset($sort['error'])){
                    if ($sort['error']=='no'){
                        echo "排序成功";
                    }
                    elseif ($sort['error']=='yes'){
                        echo "排序参数必须为数字！！！";
                    }
                }
            ?>
        </p>
    </form>
</div>

