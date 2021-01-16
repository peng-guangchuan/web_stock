<?php
header('Content-type:text/html; Charset:utf-8');
function getAllStudents($db, $sql)
{
    $res = $db->query($sql);
    return $res->fetchAll();
}
require_once('exp10_3PDO.php');
$db = new exp10_3PDO();
$select_sql = "select * from students";
if (isset($_POST['sno']) == false) {
    die(json_encode(getAllStudents($db, $select_sql)));
}
$sno = $_POST['sno'];
$psw = $_POST['psw'];
$action = $_POST['action'];
$sno = addslashes($sno);
$psw = addslashes($psw);
$name = $_POST['name'];
$title = $_POST['title'];
$partner = $_POST['partner'];
$last_time = date('Y-m-d H:i:s');
$insert_sql = "insert into students(sno,name,psw,title,last_time,state,partner) values('$sno','$name','$psw','$title','$last_time','0','$partner')";
$update_sql = "update students set name='$name',title='$title',partner='$partner',last_time='$last_time' where sno='$sno' and psw='$psw'";
if ($action == 'add') {
    try {
        $res = $db->execSQL($insert_sql);
        if ($res == 0) {
            die(json_encode(['rescode' => 1, 'msg' => "学号{$sno}已被注册。"]));
        } else {
            $data = ['rescode' => 0, 'msg' => '新增题目成功！'];
            $data['data'] = getALLStudents($db, $select_sql);
            die(json_encode($data));
        }
    } catch (Exception $e) {
        die(json_encode(['rescode' => 3, 'msg' => '服务器返回错误。']));
    }
} else {
    try {
        $res = $db->execSQL($update_sql);
        if ($res == 0) {
            die(json_encode(['rescode' => 2, 'msg' => "学号或密码错误。"]));
        } else {
            $data = ['rescode' => 0, 'msg' => '修改题目成功！'];
            $data['data'] = getAllStudents($db, $select_sql);
            die(json_encode($data));
        }
    } catch (Exception $e) {
        die(json_encode(['rescode' => 3, 'msg' => '服务器返回错误。']));
    }
}
