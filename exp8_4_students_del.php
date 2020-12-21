<?php
header('content-type:text/html;charset:utf-8');
if (!isset($_POST['sno'])) {
    header('Location:exp8_4_show_student.php');
    die;
}
require_once('exp8_4_mydb.php');
$snos = $_POST['sno'];
//$snos = implode(",", $snoArr); //把数组元素组合为字符串,元素连接用“,”
$deletesql = "Delete from students where sno = ?";
$db = new mysqli('localhost', 'root', '123456', 'web_exp6');
$stmt = $db->prepare($deletesql);
$stmt->bind_param('s', $sno);
foreach ($snos as $sno) {
    $stmt->execute();
}
echo '<p>成功删除以下学号的信息:</p>';
foreach ($snos as $sno) {
    echo "<p>{$sno}</p>";
}
include_once('exp8_4_show_student.php');
