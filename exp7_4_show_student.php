<?php
//incluce 在用到时加载,require 在一开始就加载,_once 后缀表示已加载的不加载 
header('content-type:text/html;charset:utf-8');
require_once('exp7_4_mydb.php');
$strSQL = 'select * from students order by sno';
$db = new exp7_4_mydb();
$res = $db->execSQL($strSQL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exp7_4_studentList</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0px;
            font-size: 16px;
        }

        #main {
            width: 900px;
            margin: 50px auto;
        }

        #main table {
            text-align: center;
            vertical-align: middle;
            width: 100%
        }

        tr:first-child {
            background-color: yellow;
            color: red;
            font-weight: bold;
        }

        #main table,
        #main td,
        #main th {
            border: 1px solid black;
            /*  表格的两边框合并为一条 */
            border-collapse: collapse;
        }

        #main tr {
            height: 40px;
        }

        tr:nth-child(even) {
            background-color: greenyellow;
        }

        .formcls {
            margin: 15px 0;
        }

        .formcls a {
            margin-left: 20px;
        }

        .page {
            text-align: right;
            width: 20px;
            padding-right: 5px;
        }
    </style>
</head>

<body>
    <div id="main">
        <table>
            <form action="exp7_4_students_del.php" method="post">
                <tr>
                    <th>删除</th>
                    <th>序号</th>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>题目</th>
                    <th>状态</th>
                    <th>录入时间</th>
                    <th>合作学生</th>
                </tr>

                <?php
                $page = 1;
                $pageSize = 20;
                $total_pages = ceil($res->num_rows / $pageSize); //ceil() 函数向上舍入为最接近的整数
                $res->free_result(); //释放搜索结果的内存空间
                if ($total_pages == 0) {
                    $total_pages = 1;
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if (!is_numeric($page)) { //检查输入是否为数字
                        echo "<p>输入页数错误，跳转失败！</p>";
                    }
                    if ($page < 1) { //限制最小页数
                        $page = 1;
                    }
                    if ($page > $total_pages) { //限制最大页数
                        $page = $total_pages;
                    }
                }
                $i = ($page - 1) * $pageSize;
                $sql = "select * from students order by sno asc LIMIT $i,$pageSize"; //查询从i开始的20行数据
                $res = $db->execSQL($sql);
                while ($obj = $res->fetch_object()) {
                    $i++;
                    echo "<tr>";
                    echo "<td><input type=\"checkbox\" name=\"sno[]\" value=\"{$obj->sno}\" /></td>"; //输出复选框
                    echo "<td>{$i}</td>";
                    echo "<td>{$obj->sno}</td>";
                    echo "<td>{$obj->name}</td>";
                    echo "<td>{$obj->title}</td>";
                    echo "<td>{$obj->state}</td>";
                    echo "<td>{$obj->last_time}</td>";
                    echo "<td>{$obj->partner}</td>";
                    echo "</tr>";
                }
                $res->free_result();
                ?>

        </table>
        <p style="margin-top:30px"><a href="exp7_4.html">返回输入界面</a>
            &nbsp;&nbsp;&nbsp;<input type="submit" value="确定删除" /></p>
        </form>

        <div class="formcls">
            <form action="#" method="GET">
                <input type="submit" value="翻到">
                <?php
                echo "<input type=\"text\" class=\"page\" name=\"page\" value=\"{$page}\" maxlength=\"3\" required=\"required\"/>/{$total_pages}页\n";
                $pre = $page;
                if ($pre != 1) {
                    $pre--;
                }
                $next = $page;
                if ($next != $total_pages) {
                    $next++;
                }
                echo '<a href="exp7_4_show_student.php?page=', $pre, '">前一页</a>';
                printf("<a href=\"exp7_4_show_student.php?page=%d\">后一页</a>", $next);
                ?>
            </form>
        </div>
    </div>
</body>