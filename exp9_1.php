<?php
    header('content-type:text/html;charset:utf-8');
    $users = ["tom","jack","admin"];
    $data = $_GET['user'];
    if(in_array($data,$users)){
        echo 0;
    }else{
        echo 1;
    }
?>