<?php
header('content-type:text/html;charset:utf-8');
if (!isset($_POST['sno'])) {
    header('Location:exp7_4_show_student.php');
    die;
}
require_once('exp7_4_mydb.php');
$snoArr = $_POST['sno'];
$snos = implode(",", $snoArr); //把数组元素组合为字符串,元素连接用“,”
$deletesql = "Delete from students where sno in ($snos)";
$db = new exp7_4_mydb();
$res = $db->execSQL($deletesql);
echo '<p>成功删除以下学号的信息:</p>';
foreach ($snoArr as $sno) {
    echo "<p>{$sno}</p>";
}
include_once('exp7_4_show_student.php');
