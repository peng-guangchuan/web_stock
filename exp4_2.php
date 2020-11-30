<?php
header('Content-type：text/html;charset=utf-8');
$str = 'The Quick Brown Fox.';
echo $str . "<br />"; //输出原字符串
$str = strtolower($str); //将所有字符变成小写
echo $str . "<br />"; //输出小写字符串
echo str_replace('brown', 'red', $str) . "<br />"; //对$str中的brown单词替换成red单词
$len = strlen($str); //获取str字符串长度
$ord_a = ord('a'); //返回字符串 string 第一个字符的 ASCII 码值。该函数是chr()的互补函数。
$ord_z = ord('z');
$array = str_split($str); //将字符串str分割成单个字符放入array数组
for ($i = 0; $i < $len; ++$i) {
    $ord_cur = ord($array[$i]); //获取array数组中第i个字符的ascii码
    if ($ord_cur >= $ord_a and $ord_cur <= $ord_z) { //如果该字符在a-z内的，就替换（排除空格符）
        $ord_swi = $ord_cur + 5;
        if ($ord_swi <= $ord_z) { //移动加密后如果没有超出a-z的范围就直接输出
            echo chr($ord_swi);
        } else { //超出了则循环会字母表开头
            echo chr($ord_swi - $ord_z + $ord_a - 1);
        }
    } else { //不在a-z内的字符直接输出
        echo chr($ord_cur);
    }
}
