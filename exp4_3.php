<?php
header('Content-type：text/html;charset=utf-8');
$cityArr = array(
    "广州" => "020",
    "深圳" => "0755",
    "珠海" => "0756",
    "东莞" => "0769",
    "汕头" => "0754"
);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>实验4_3</title>

    <style type="text/css">
        * {
            margin: 0;
            font-size: 16pt;
        }

        body {
            background-color: #e6e6fa;
            font-family: 微软雅黑;
        }

        div.main {
            width: 400px;
            padding: 30px;
            padding-right: 150px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="main">

        <tr>
            <td class="biaoti">你的手机号：</td>
            <td class="neirong"> <?php echo $_POST["phone"] . "<br />" ?></td>
        </tr>
        <tr>
            <td class="biaoti">创建密码：</td>
            <td class="neirong"><?php echo $_POST["psw"] . "<br />" ?></td>
        </tr>
        <tr>
            <td class="biaoti">昵称：</td>
            <td class="neirong"><?php echo $_POST["name"] . "<br />" ?></td>
        </tr>

        <tr>
            <td class="biaoti">性别：</td>
            <td class="neirong"><?php echo $_POST["gender"] . "<br />" ?></td>
        </tr>

        <tr>
            <td class="biaoti">所在地：</td>
            <td class="neirong"><?php echo $_POST["city"] . "<br />" ?></td>
        </tr>

        <tr>
            <td class="biaoti">所在区号：</td>
            <td class="neirong"><?php echo $cityArr[$_POST["city"]] . "<br />" ?></td>
        </tr>
        <tr>
            <td class="biaoti">手机验证码：</td>
            <td class="neirong"> <?php echo $_POST["checkcode"] . "<br />" ?></td>
        </tr>
    </div>
</body>

</html>


<!-- <?php
        $cityArr = array(
            "广州" => "020",
            "深圳" => "0755",
            "珠海" => "0756",
            "东莞" => "0769",
            "汕头" => "0754"
        );
        ?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>实验1</title>
     
    <style type="text/css">
        * {margin:0; font-size:16pt;}
        body {background-color:#e6e6fa; 
              font-family:微软雅黑;
              }             
        div.main {width:400px; 
                 padding:30px; 
                 padding-right:150px;
                 margin:0 auto;
             }
         
        input[type="text"], input[type="password"] {border:2px solid #20b2aa; 
               height:25px; 
               width:200px;}
                
        label {text-align:right; 
               width:150px;
               display:inline-block;
               /*border:1px solid;*/
               }
         
        input[type="submit"]  {cursor:pointer; 
                               margin-left:5px;
                               height:40px; 
                               width:110px; 
                               font-size:18pt;}
     
        p    {margin-top:5px;    }
    </style>
</head>
<body>
    <div class="main">
        <p><label>你的手机号：</label>
           <?php echo $_POST["phone"] ?>
        </p>
            
        <p><label>创建密码：</label>
           <?php echo $_POST["psw"] ?>  
        </p>
         
        <p><label>昵称：</label>
           <?php echo $_POST["nickname"] ?>
        </p>
         
        <p><label>性别：</label>
            <?php echo $_POST["gender"] ?>
        </p>
         
        <p><label>所在地：</label>            
            <?php echo $_POST["city"] ?>
        </p>
         
        <p><label>所在区号：</label>
            <?php echo $cityArr[$_POST["city"]] ?>
        </p>
        <p><label>手机验证码：</label>
            <?php echo $_POST["checkcode"] ?>
        </p>
    </div>
</body>
</html> -->