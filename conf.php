<?php

////if(!defined("IP")) define("IP","192.168.1.108");
//if(!defined("IP")){
//    if(strtolower(PHP_OS) == 'linux'){
//        define("IP","10.48.30.87");
//    }else{
//        define("IP","127.0.0.1");
//    }
//}
//
//if(!defined("MOBILEINFO")){
//    if(strtolower(PHP_OS) == 'linux'){
//        define("MOBILEINFO","./libs/mobile_info.xml");
//    }else{
//        define("MOBILEINFO","./libs/mobile_info.xml");
//    }
//}
//
//
//if(!defined("PORT")){
//    if(strtolower(PHP_OS) == 'linux'){
//        define("PORT","8011");
//    }else{
//        define("PORT","8080");
//    }
//}

$port = $_GET["port"];
$ip = $_GET["ip"];
$config = include_once "./data/config.php";
$config["port"] = $port;
$config["ip"] = $ip;
file_put_contents("./data/config.php","<?php return ".var_export($config,TRUE).";");
echo "配置成功";
