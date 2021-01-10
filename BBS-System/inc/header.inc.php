<?php
include_once "config.inc.php";
include_once "mysql.inc.php";

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title><?php echo $template['title']; ?></title>
    <meta name="keywords" content="<?php echo $data_info['keywords']?>" />
    <meta name="description" content="<?php echo $data_info['description']?>" />
    <link rel="stylesheet" type="text/css" href="style/publics.css" />
    <link rel="stylesheet" href="<?php echo $template['css'];?>">
    <script src="../js/jquery-1.11.3.min.js"></script>
    <?php
    if (basename($_SERVER['SCRIPT_NAME'])=='login.php'||basename($_SERVER['SCRIPT_NAME'])=='register.php'){
        $html = <<<A
A;
        echo $html;
    }
    ?>
</head>

<body>
<!-- 头部 -->
<div class="header_wrap">
    <div id="header" class="auto">
        <div class="logo">仲园论坛</div>
            <div class="nav">
                <a class="hover" href="./index.php">首页</a>
            </div>
            <div class="serarch">
                <form action="search.php" method="get">
                    <input class="keyword" type="text" name="keyword" value="<?php if(isset($_GET['keyword']))echo $_GET['keyword']?>" placeholder="搜索其实很简单" />
                    <input class="submit" type="submit" name="submit" value="" />
                </form>
            </div>
            <div class="login" style="width:200px;">
                <?php
                if (!$member_id){
                    echo "<a href=\"./login.php\">登录</a>&emsp;";
                    echo "<a href=\"./register.php\">注册</a>";
                }
                else{
                    $link = connect();
                    $query = "select * from sfk_member where name='{$_COOKIE['sfk']['name']}'";
                    $result = execute($link,$query);
                    $result_data = mysqli_fetch_assoc($result);
                    echo "<a href='member.php?id={$result_data['id']}' style='color: whitesmoke;font-size: 16px;font-weight:bold;float:left;'>您好!".$_COOKIE['sfk']['name']."</a>".'<a href="login_out.php" style="font-size: 16px;float: right;color:#8B008B;font-weight:bold;">|[退出]</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</boby>
</html>
