<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
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
if (isset($_POST['submit']))
{
    if (empty($_POST['module_name'])){
        $modulename['null']='yes';
    }elseif (!is_numeric($_POST['sort'])){
        $sort['num']='not';
    }elseif (isSame()){
        $isSame["module_name"]='equal';
    }
    else{
        $query = "insert into sfk_father_module(module_name,sort) values ('{$_POST['module_name']}','{$_POST['sort']}')";
        $link = connect();
        execute($link,$query);
        $add_module['success']='yes';
    }
}

$template['title']="添加父板块";
?>
<?php include_once 'inc/header.inc.php'?>
<div id="right">
    <div class="title">添加父版块</div>
    <div class="father_m_add">
        <form method="post">
            <div>
                <span>版块名称：</span>
                <input name="module_name" type="text" maxlength="60" size="20"><span1>*版块名称不得为空，最大不得超过60个字符</span1>
            </div><br>
            <div>
                <span>排&emsp;&emsp;序：</span>
                <input name="sort" type="text"><span1>*填写一个数字即可</span1>
            </div><br><br>
            <input class="btns" type="submit" name="submit" value="添加" />
            <p><?php
                if (isset($modulename['null'])){
                    echo "模块名称不为空";
                } elseif(isset($sort['num'])){
                    echo "排序必须为数字";
                }
                elseif (isset($isSame['module_name'])){
                    echo "模块名{$_POST['module_name']}不能出现多次；";
                }
                else if (isset($add_module['success'])){
                    echo "添加成功,模块名：{$_POST['module_name']}，排序名：{$_POST['sort']}";
                }
                ?></p>
        </form>
    </div>
</div>

