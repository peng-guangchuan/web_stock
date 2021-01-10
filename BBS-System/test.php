<!--分页函数操作，很强大！！！-->
<?php
header("Content-type:text/html;charset=utf-8");
//不添加header也无乱码
//var_dump(page(50,10,'page',10));
$page = page(100,10,'page',2);
echo $page['html'];
echo "当前页面为".$_GET['page'];
?>