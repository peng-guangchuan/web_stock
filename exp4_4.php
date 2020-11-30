<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>乘法口诀表</title>

    <style type="text/css">
        tr:first-child,
        td:first-child {
            color: red;
            font-weight: bold;
            font-size: 21px;
        }
        td{
            /* 设置每一个格子的宽度，否则首行首列会因为自动宽度变的很窄 */
            width: 75px;
        }
        div table{
            /* 根据每一个格子宽度设置总宽度 */
            width: 750px;
            margin: 0 auto;
        }
        table{
            text-align: center;
            vertical-align: middle;
            border-collapse: collapse;
        }
        table,td,th{
            border:1px solid black;
        }
    </style>

</head>

<body>
    <div>
        <table>
            <caption>乘法口诀表</caption>
            <?php
            echo "<tr><th> × </th>";//打印第一行乘号和1~9的数字
            for ($j = 1; $j <= 9; $j++) {
                echo "<th>{$j}</th>";
            }
            echo "</tr>";

            for($i=1; $i<=9; $i++){
                echo "<tr>";
                echo "<td>{$i}</td>";//打印第一列1~9数字

                for($j=1; $j<=$i; $j++){
                    echo "<td> {$i}×{$j}=" . $i*$j . "</td>";//输出乘法口诀表内容
                }
                for($j=$i+1;$j<=9;$j++){
                    echo "<td>&nbsp;</td>";//输出空白格
                }

                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>