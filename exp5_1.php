<?php
$prices = [1 => 2.0, 4.0, 3.0, 6.0];
$names = [1 => "4个100瓦灯泡", "8个100瓦灯泡", "4个100瓦节能灯泡", "8个100瓦节能灯泡"];
$payways = [1 => "Visa", "MasterCard", "银联"];

$user = $_REQUEST["username"];
$lightChoice = $_REQUEST["light"];
$payChoice = $_REQUEST["pay"];

$total = 0;
$payOff = 0;

foreach ($lightChoice as $key) {
    $total += $prices[$key];
}

$payOff = $total * 0.7;
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exp5_1:订单</title>
    <style type="text/css">
        #main {
            margin: 50px auto;
            width: 400px;
        }

        span {
            vertical-align: middle;
            margin: 0px;
        }

        .light {
            width: 200px;
            padding: 0px 0px 10px 15px;
            display: inline-block;
        }

        .price {
            width: 150;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div id="main">
        <h3>尊敬的用户<?php echo $user ?>你购买了以下产品</h3>
        <div>
            <?php
            foreach ($lightChoice as $key) {
            ?>
                <span class="light"><?php echo $names[$key]; ?></span>
                <span class="price">￥<?php echo $prices[$key]; ?></span>
            <?php
            }
            ?>
        </div>
        <div>
            <hr />
            <span class="light">支付方式：<?php echo $payways[$payChoice]; ?></span>
        </div>

        <div>
            <span class="light">原价：￥<?php echo $total; ?></span>
            <span class="price">优惠价：￥<?php echo $payOff; ?></span>
        </div>
    </div>
</body>

</html>