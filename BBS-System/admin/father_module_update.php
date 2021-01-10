<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$template['title']="父板块修改";
?>
<?php
function isSame(){
    $link = connect();
    $query = "select * from sfk_father_module where module_name='{$_POST['module_name']}'";
    $result = execute($link,$query);
    if(mysqli_num_rows($result)>=1){
        return true;
    }
    else{
        return false;
    }
}
?>
<?php

    if (isset($_GET['id'])){
        $link = connect();
        $query = "select * from sfk_father_module where id = '{$_GET['id']}';";
//        php代码内部使用{}是能正确识别变量的，但是在html代码里面是不行的
        $result = execute($link,$query);
        if (mysqli_num_rows($result)>=1){
            $data = mysqli_fetch_assoc($result);
//           一行一行从result中获取，可以使用循环，mysql_fetch_row和这个作用一样，但是通过下标数字获取值
            $module_change = $data['module_name'];
            $sort_change = $data['sort'];
        }
    }

    if (empty($_POST['module_name'])){
        $modulename['null']='yes';
    }elseif (!is_numeric($_POST['sort'])){
        $sort['num']='not';
    }
    elseif(isset($_POST['module_name'])){
        $link = connect();
        $query = "update sfk_father_module set module_name='{$_POST['module_name']}' , sort='{$_POST['sort']}' where id='{$_GET['id']}';";
        $module_change = $_POST['module_name'];
        $sort_change = $_POST['sort'];
        execute($link,$query);
        if (mysqli_affected_rows($link)>=1){
            $change['success']='yes';

        }
    }
?>

<?php include_once 'inc/header.inc.php';?>
    <div id="right">
    <div class="title">父版块修改</div>
        <table class="list">
            <form method="post" action="father_module_update.php?id=<?php echo $_GET['id']?>">
                <table class="au">
                    <tr>
                        <td>版块名称</td>
                        <td><input name="module_name" type="text" maxlength="60" size="20" value="<?php echo $data['module_name']?>"/></td>
                        <td >
                            版块名称不得为空，最大不得超过66个字符
                        </td>
                    </tr>
                    <tr>
                        <td>排序</td>
                        <td><input name="sort" value="<?php echo $data['sort']?>" type="text"/></td>
                        <td>
                            填写一个数字即可
                        </td>
                    </tr>
                </table>
                <input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="修改" />
                <p><?php
                    if (isset($modulename['null'])){
                        echo "模块名称不为空";
                    } elseif(isset($sort['num'])){
                        echo "排序必须为数字";
                    }
                    else if (isset($change['success'])){
                        echo "更新成功,模块名：{$_POST['module_name']}，排序名：{$_POST['sort']}";
                    }
                    ?></p>
            </form>
        </table>
    </div>

