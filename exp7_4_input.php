<?php
header('content-type:text/html;charset:utf-8');

if (!isset($_POST['sno'])) {
    header('Location:exp6_2_error.html');
}

require_once('exp6_2_mydb.php');
$db = new exp6_2_mydb();

$sno = $_POST['sno'];
$name = $_POST['name'];
$psw = $_POST['psw'];
$last_time = date('Y-m-d H:i:s');
$title = $_POST['title'];
$partner = $_POST['partner'];
$action = $_POST['action'];

$insertSQL = "insert into students(sno,name,psw,title,last_time,state,partner) values('$sno','$name','$psw','$title','$last_time','0','$partner')";
$updateSQL = "update students set name='$name',title='$title',partner='$partner',last_time='$last_time' where sno='$sno' and psw='$psw'";

if($action == 'add'){
    $res = $db->execSQL($insertSQL);
    $resaf = $db->getAffectedRows();
    if( !$res || !$resaf ){
        echo "<p>学号{$sno}已被注册！</p>";
        include_once('exp6_2_error.html');
        exit;
    }
    echo "<p>题目已新增！</p>";
}else{
    $res = $db->execSQL($updateSQL);
    $resaf = $db->getAffectedRows();
    if (!$res || !$resaf){
        echo "<p>学号或密码错误！</p>";
        include_once('exp6_2_error.html');
        exit;
    }
    echo "<p>题目修改成功！</p>";
}
include('exp6_2_show_student.php');