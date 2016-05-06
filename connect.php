<?php
    header("Content-type:text/html;charset:utf-8");
    date_default_timezone_set('Asia/Shanghai'); 
    define('HOST','localhost');

    // define('USERNAME','nieyeni_patrol');
    // define('PASSWORD','iampatrol');
    // if(!($con=mysql_connect(HOST,USERNAME,PASSWORD))){
    //     echo mysql_error(); 
    // }
    // if(!mysql_select_db('nieyeni_patrol')){
    //     echo mysql_error(); 
    // }

    define('USERNAME','root');
    define('PASSWORD','123456');
    if(!($con=mysql_connect(HOST,USERNAME,PASSWORD))){
        echo mysql_error(); 
    }
    if(!mysql_select_db('meiya')){
        echo mysql_error(); 
    }
    if(!mysql_query('set names utf8')){
        echo mysql_error();
    }
?>