<?php
header('content-type:text/html;charset:utf-8');

$data = file_get_contents('exp9_2_data.txt');
$votes = explode(",", $data); //按照逗号分割成字符串数组
//print_r($votes);  Array ( [0] => 0 [1] => 0 [2] => 0 )

// if (isset($_GET['time'])) {
//     $t = $_GET['time'];
//     if (isset($_COOKIE['oneDay'])) {

//         if ($t == 0) {
//             setcookie("oneDay", "1day", time() - 86400); //设置时限为t秒
            if (isset($_GET['id'])) {
                $flowerid = $_GET['id'];
                $votes[$flowerid]++;
                $data = implode(",", $votes); //按照逗号合并成字符串
                file_put_contents('exp9_2_data.txt', $data);
            }
//         } else {
//             setcookie("oneDay", "1day", time() + $t); //设置时限为t秒
//         }
//     }
// }
echo json_encode($votes);
