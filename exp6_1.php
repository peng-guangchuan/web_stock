<?php
if (isset($_POST['remember'])) { //获取是否勾选记住一周
    $remember = $_POST['remember'];
}

if (isset($_POST['username']) == false) { //获取用户名是否输入
    $username = $_COOKIE['username']; // 未输入，寻找网页的cookie
    $pwd = $_COOKIE['password'];
    $remember_str = $_COOKIE['remember'];
    $remember = unserialize($remember_str);
} else {
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    if (isset($_POST['remember']) == false) { //是否有记住一周
        $remember = null;
    } else {
        $remember = $_POST['remember'];
    }
}

if (isset($username) == false) { //用户名不存在，跳转登陆页面
    header("Location:exp6_1.html");
}

if (isset($remember)) { // 是否勾选了记住一周，存储cookie
    setcookie('username', $username, time() + 30 * 86400); //如果不设置time()，那么 cookie 将在 session 结束后（即浏览器关闭时）自动失效。
    setcookie('password', $pwd, time() + 30 * 86400);
    $remember_str = serialize($remember);
    setcookie('remember', $remember_str, time() + 30 * 86400);
} else {
    setcookie('username', $username, time() - 30 * 86400); //如果不设置time()，那么 cookie 将在 session 结束后（即浏览器关闭时）自动失效。
    setcookie('password', $pwd, time() - 30 * 86400);
    $remember_str = serialize($remember);
    setcookie('remember', $remember_str, time() - 30 * 86400);
}

$db = new mysqli('localhost', "root", "123456", 'web_exp6'); //连接mysql数据库，主机、用户名、密码、数据库名
if ($db->connect_errno) { //判断数据库是否连接失败
    echo '连接错误' . $db->connect_error;
    die($db->connect_error);
}
$db->query("SET NAMES 'utf8'"); //临时设置字符格式，防止显示结果乱码
$time = date('Y-m-d H:i:s'); //格式化本地时间
$sql1 = sprintf("select * from exp6_1_user where id = '%s' and psw = '%s' ", $username, $pwd);
$res = $db->query($sql1);

if ($res->num_rows == 0) { //查询结果数为0，无法登陆并退出
    header('Content-Type:text/html;charset=UTF-8');
    echo '<h2>用户名或密码错误！请<a href="exp6_1.html">重新登陆</a></h2>';
    exit(); //退出
}

while ($obj = $res->fetch_object()) { //获取结果数据并输出
    echo "<div class=\"main\">";
    echo "<h2>欢迎您  {$obj->name}</h2>";
    echo "<p>您上次的登录时间是  {$obj->time}</p>";
    echo "</div>";
}

$sql2 = sprintf("update exp6_1_user set time = '%s' where id = '%s' ", $time, $username);
$db->query($sql2); //更新本次登陆时间
$db->close(); //关闭连接
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exp6_1.php</title>
</head>
<style type="text/css">
    .main {
        width: 350px;
        margin: 0 auto;
        background-color: darkgray;
        padding: 10px 10px 10px 10px;
    }
</style>

<body>

</body>

</html>