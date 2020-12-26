<?php
header('content-type:text/html;charset:utf-8');
$guangdong = array("广州市", "深圳市", "梅州市");
$sichuan = array("成都市", "自贡市", "南充市");
$hubei = array("武汉市", "黄石市", "十堰市");
$guangdongPop = array("广州市" => "927.7", "深圳市" => "454.7", "梅州市" => "438.30");
$guangdongArea = array("广州市" => "7434.4", "深圳市" => "2019.95", "梅州市" => "15925");
$sichuanPop = array("成都市" => "1476", "自贡市" => "322.66", "南充市" => "723.71");
$sichuanArea = array("成都市" => "12098", "自贡市" => "4382", "南充市" => "12514");
$hubeiPop = array("武汉市" => "853.6", "黄石市" => "247.07", "十堰市" => "346.16");
$hubeiArea = array("武汉市" => "8483", "黄石市" => "4576", "十堰市" => "23698");
$citys = array("0" => "0", $guangdong, $sichuan, $hubei);
$pop = array("0" => "-请选择-", "1" => array_flip($guangdongPop), array_flip($sichuanPop), array_flip($hubeiPop));
$area = array("0" => "-请选择-", "1" => array_flip($guangdongArea), array_flip($sichuanArea), array_flip($hubeiArea));

$proid = $_POST['provinceid'];
//echo array_search($pro,$citys);
$city = $citys[$proid];
if (!isset($_POST['city'])) {
    echo json_encode($city);
} else {
    $c = $_POST['city'];
    $cpop = $pop[$proid];
    $carea = $area[$proid];
    $a = array_search($c, $carea);
    $p = array_search($c, $cpop);
    $res = array("area" => $a, "population" => $p);
    echo json_encode($res);
}
