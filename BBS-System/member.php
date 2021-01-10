<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$template['title'] = "用户页";
$template['css'] = "style/list.css";
$template['css1'] = "style/member.css";
$link = connect();
$member_id = is_login($link);

if(!isset($_GET['id'])){
    echo "请输入会员id号";
    exit();
}
$query="select * from sfk_member where id={$_GET['id']}";
$result_memebr=execute($link, $query);
if(mysqli_num_rows($result_memebr)!=1){
    skip('index.php', 'error', '你所访问的会员不存在!');
}
$data_member=mysqli_fetch_assoc($result_memebr);
$query="select count(*) from sfk_content where member_id={$_GET['id']}";
$count_all=num($link, $query);
?>
<?php include_once 'inc/header.inc.php'?>;
    <div style="margin-top:50px;"></div>
    <div id="position" class="auto">
        <a href="index.php">首页</a> &gt; <?php echo $data_member['name']?>
    </div>
    <div id="main" class="auto">
        <div id="left">
            <ul class="postsList">
                <?php
                $page=page($count_all,3,5);
                $query="select
			sfk_content.title,sfk_content.member_id,sfk_content.id,sfk_content.time,sfk_content.times,sfk_member.name,sfk_member.photo,
			sfk_member.id mid from sfk_content,sfk_member where
			sfk_content.member_id={$_GET['id']} and
			sfk_content.member_id=sfk_member.id order by id desc {$page['limit']}";
                $result_content=execute($link, $query);
                while($data_content=mysqli_fetch_assoc($result_content)){
                    $data_content['title']=htmlspecialchars($data_content['title']);
                    $query="select time from sfk_reply where content_id={$data_content['id']} order by id desc limit 1";
                    $result_last_reply=execute($link, $query);
                    if(mysqli_num_rows($result_last_reply)==0){
                        $last_time='暂无';
                    }else{
                        $data_last_reply=mysqli_fetch_assoc($result_last_reply);
                        $last_time=$data_last_reply['time'];
                    }
                    $query="select count(*) from sfk_reply where content_id={$data_content['id']}";
                    ?>
                    <li>
                        <div class="smallPic">
                            <a href="#">
                                <img width="50" height="50" src="<?php if($data_content['photo']!=''){echo $data_content['photo'];}else{echo 'style/old.gif';}?>"/>
                            </a>
                        </div>
                        <div class="subject">
                            <div class="titleWrap"><h2><a target="_blank" href="show.php?id=<?php echo $data_content['id']?>"><?php echo $data_content['title']?></a></h2></div>
                            <p>
                                发帖日期：<?php echo $data_content['time']?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：<?php echo $last_time?>
                            </p>
                            <p>
                                <?php
                                if (check_user($member_id,$data_content['member_id'])){
                                    echo "<a href='content_update.php?id={$data_content['id']}'>编辑&emsp;</a> <a href=\"content_delete.php?id={$data_content['id']}\">删除</a>";
                                }
                                ?>
                            </p>
                        </div>
                        <div class="count">
                            <p>
                                回复<br /><span><?php echo num($link,$query)?></span>
                            </p>
                            <p>
                                浏览<br /><span><?php echo $data_content['times']?></span>
                            </p>
                        </div>
                        <div style="clear:both;"></div>
                    </li>
                <?php }?>
            </ul>
            <div class="pages">
                <?php
                echo $page['html'];
                ?>
            </div>
        </div>
        <?php
            $query = "select * from sfk_member where id={$_GET['id']}";
            $result = execute($link,$query);
            $data = mysqli_fetch_assoc($result);
        ?>
        <div id="right">
            <div class="member_big">
                <dl>
                    <dt>
                        <img width="180" height="180" src="<?php if($data['photo']!=''){echo $data['photo'];}else{echo 'style/old.gif';}?>" />
                    </dt><br><br>
                    <dd style="font-size: 20px;">用户名：<?php echo $data['name']?></dd>
                    <dd style="font-size: 20px;">帖子总计：<?php echo $count_all?></dd>
                    <?php
                        if ($data['name']==$_COOKIE['sfk']['name']){
                    ?>
                        <dd style="font-size: 20px;">操作：<a style="color: blue" href="list_son.php?id=
                        <?php echo $_GET['id']?>" target="_blank">发布帖子</a></dd>
                        <dd style="font-size: 20px;">操作：<a style="color: blue" href="member_photo_update.php?id=<?php echo $_GET['id']?>" target="_blank">修改头像</a></dd>
                        <dd style="font-size: 20px;">操作：<a style="color: blue" href="changename.php?id=<?php echo $_GET['id']?>" target="_black">修改用户名</a></dd>
                        <dd style="font-size: 20px;">操作：<a style="color: blue" href="changepassword.php?id=<?php echo $_GET['id']?>" target="_black">修改密码</a></dd>
                        <dd style="font-size: 20px;">操作：<a style="color: blue" href="feedback.php" target="_blank">建议反馈</a></dd>
                        <dd style="font-size: 20px;">说明：<a style="color: blue" href="explain.php" target="_blank">用户说明</a></dd>
                    <?php }?>
                </dl>
                <div style="clear:both;"></div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
