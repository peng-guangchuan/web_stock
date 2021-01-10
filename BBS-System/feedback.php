<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$template['title']='反馈建议页';
$template['css']='style/publish.css';
$link = connect();
$member_id = is_login($link);
?>
<?php
    $send['success'] = null;
    $content['null'] = null;
    if (isset($_POST['submit'])){
        if ($_POST['content']==''){
            $content['null'] = 'yes';
        }
        else{
            $query = "insert into sfk_feedback(name, content, time) values ('{$_POST['name']}','{$_POST['content']}',now())";
            execute($link,$query);
            $send['success'] = 'yes';
        }
    }
?>
<?php include 'inc/header.inc.php'?>
<div style="margin-top:60px;"></div>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt;反馈建议页
    </div>
    <div id="publish">
    <form method="post">
        <span>用户名：</span>
        <input type="text" name="name"/>
        <textarea name="content" class="content"></textarea>
        <input style="padding:5px;margin-top:10px;font-size:18px;" type="submit" name="submit" value="发送" />
        <div style="clear:both;"></div>
        <p style="font-size: 16px">
            <?php 
                if (isset($send['success'])){
                    echo "发送成功！";
                } elseif (isset($content['null'])){
                    echo "内容不得为空";
                } 
            ?>
        </p>
    </form>
</div>

