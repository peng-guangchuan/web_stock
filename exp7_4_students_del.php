<?php
header('content-type:text/html;charset:utf-8');
if (!isset($_POST['sno'])) {
    header('Location:exp6_2_show_student.php');
    die;
}
require_once('exp6_2_mydb.php');
$snoArr = $_POST['sno'];
$snos = implode(",", $snoArr); //把数组元素组合为字符串,元素连接用“,”
$deletesql = "Delete from students where sno in ($snos)";
$db = new exp6_2_mydb();
$res = $db->execSQL($deletesql);
echo '<p>成功删除以下学号的信息:</p>';
foreach ($snoArr as $sno) {
    echo "<p>{$sno}</p>";
}
include_once('exp6_2_show_student.php');
