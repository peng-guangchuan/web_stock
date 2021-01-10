<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link=connect();
$template['title']="帖子管理";
?>
<?php
$delete['success'] = null;
    if (isset($_GET['id'])){
        $query = "delete from sfk_content where id={$_GET['id']}";
        $result = execute($link,$query);
        if (mysqli_affected_rows($link)==1){
            $delete['success'] ='yes';
        }
        else{
            $delete['success'] = 'no';
        }
    }
?>
<?php include_once 'inc/header.inc.php '?>
<link rel="stylesheet" type="text/css" href="style/reply.css" />
<div class = "right">
    <div class="title">帖子管理</div>
        <form method="post">
            <table class="list">
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>content</th>
                    <th>time</th>
                    <th>操作</th>
                </tr>
                <?php
                    $query = "select * from sfk_content";
                    $result = execute($link,$query);
                    while ($data = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $data['id']?></td>
                    <td><?php echo $data['title']?></td>
                    <td><?php echo $data['content']?></td>
                    <td><?php echo $data['time']?></td>
                    <td>&nbsp;&nbsp;<a href="postmanage.php?id=<?php echo $data['id']?>">[删除]</a></td>
                </tr>
                <?php }?>
            </table>
            <p>
                <?php
                    if (isset($delete['success'])){
                        if ($delete['success']=='yes'){
                            echo "删除成功";
                        }
                        else{
                            echo "删除失败";
                        }
                    }
                ?>
            </p>
        </form>
    </div>
</div>

