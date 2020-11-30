<?php
//新浪云 Storage PHP use
use sinacloud\sae\Storage as Storage;

header("Content-type: text/html; charset=utf-8");
if (!isset($_POST['MAX_FILE_SIZE'])) {
    header('Location:exp5_2.html');
    exit;
}
$show = ['image/gif', 'image/jpeg', 'image/png', 'image/bmp'];
$download = [
    'application/msword', 'application/pdf', 'application/vnd.ms-excel', 'text/plain',
    'application/vnd.ms-powerpoint', 'text/html', 'application/x-httpd-php', 'application/x-javascript'
];

// 　$_FILES['myFile']['name'] 客户端文件的原名称       
// 　$_FILES['myFile']['type'] 文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"       
// 　$_FILES['myFile']['size'] 已上传文件的大小，单位为字节       
// 　$_FILES['myFile']['tmp_name'] 文件被上传后在服务端储存的临时文件名，一般是系统默认，可以在php.ini的upload_tmp_dir指定，但用 putenv() 函数设置是不起作用的
// 　$_FILES['myFile']['error'] 和该文件上传相关的错误代码

// 其值为 0，没有错误发生，文件上传成功。
// UPLOAD_ERR_INI_SIZE  其值为 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。
// UPLOAD_ERR_FORM_SIZE 其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。
// UPLOAD_ERR_PARTIAL 其值为 3，文件只有部分被上传。
// UPLOAD_ERR_NO_FILE 其值为 4，没有文件被上传。
// UPLOAD_ERR_NO_TMP_DIR 其值为 6，找不到临时文件夹。PHP 4.3.10 和 PHP 5.0.3 引进。
// UPLOAD_ERR_CANT_WRITE 其值为 7，文件写入失败。PHP 5.1.0 引进
function fileInfo()
{
    global $show, $download; //函数内部使用全局变量加global
    $file = $_FILES['file'];
    for ($i = 1, $cnt = count($file['name']); $i <= $cnt; ++$i) {
        echo "<div class=\"row\"><span class=\"title\">文件{$i}：</span>";

        if ($file['error'][$i - 1] > 0) { //大于 0 即文件上传发生了错误。 
            if ($file['error'][$i - 1] == 2) { //值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。
                echo "错误：UPLOAD_ERR_FORM_SIZE！上传文件超过5M限制。 </div>";
                continue;
            }

            if ($file['error'][$i - 1] == 4) { //值为 4，没有文件被上传。
                echo "错误：UPLOAD_ERR_NO_FILE！没有文件被上传。</div>";
                continue;
            }

            echo "{$file['error'][$i - 1]}";
            echo "错误：文件上传失败！</div>";
            continue;
        }

        if (!(in_array($file['type'][$i - 1], $show) || in_array($file['type'][$i - 1], $download))) { //按值查找，判断文件类型是否满足规定
            echo "错误：文件类型不符合要求！</div>";
            continue;
        }

        //以下使用云存储
        //在新浪云运行环境中时可以不传认证信息，默认会从应用的环境变量中取
        $s = new Storage();
        //创建Bucket exp5_2_storage 并返回true，若控制台中已经存在该Bucket，则返回false
        $s->putBucket('exp5_2_storage');
        $fname = $file['name'][$i - 1];
        $ftmp_name = $file['tmp_name'][$i - 1];
        //把 $_FILES 全局变量中的缓存文件上传到 exp5_2_storage 这个 Bucket，设置此 Object 名为 $fname
        $res = $s->putObjectFile($ftmp_name, "exp5_2_storage", $fname);

        if (!$res) {
            echo '错误：文件上传失败！</div>';
            continue;
        }

        //以下使用本地存储
        //        if (PATH_SEPARATOR == ';')
        //            $fname = mb_convert_encoding($file['name'][$i - 1], "UTF-8", 'GB2312');
        //        else
        //            $fname = $file['name'][$i-1];
        //        $filepath = 'upload/'.$fname;
        //        move_uploaded_file($file['tmp_name'][$i-1],$filepath);
        //        if (PATH_SEPARATOR == ';') {
        //            $fname = mb_convert_encoding($file['name'][$i - 1], "GB2312", 'UTF-8');
        //            $filepath = 'upload/'.$fname;
        //        }

        
        //若Bucket exp5_2_storage 的访问权限为公开，也可直接调用 getUrl('exp5_2_storage',$fname) 接口
        //为私有Bucket exp5_2_storage中的 $fname 文件生成一个能够在外网用GET方式临时访问的URL,此URL有效时间有300s
        $filepath = $s->getTempUrl('exp5_2_storage', $fname, 'GET', 300);//创建一个能访问Bucket中文件的链接url，有效时间为300s
        //输出文件内容
        if (in_array($file['type'][$i - 1], $show)) {
            echo "<img class=\"img\" src=\"{$filepath}\" alt=\"img\" ></div>";
        } else {
            echo "<span class=\"download\">文件下载：<a href=\"{$filepath}\">{$fname}</a></span></div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>exp5_2</title>
    <style type="text/css">
        #container {
            margin: 0 auto;
            padding: 1px 20px 30px 20px;
            width: 488px;
        }

        .row {
            display: block;
            width: 488px;
            border-bottom: 1px gray solid;
        }

        .title,
        .img,
        .download {
            display: block;
            margin: 20px 0;
        }

        .img {
            width: 188px;
            height: auto;
        }
    </style>
</head>

<body>
    <div id="container">
        <?php
        fileInfo();
        ?>
    </div>
</body>

</html>