<?php
   $config = include_once "./data/config.php";
?>


<html>
<head>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="./static/css/common.css"/>
    <link type="text/css" rel="stylesheet" href="./static/css/config.css"/>
    <script type="text/javascript" src="./static/js/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="./static/js/config.js"></script>
</head>
<body>
<div class="header">
    <div class="logo"></div>
    <div class="nav">
        <ul>
            <a href="index.php"><li>全部</li></a>
            <a href="filter.php"><li>过滤</li></a>
            <a href="config.php"><li style="background-color: #ffffff;color:#000000;">配置</li></a>
        </ul>
    </div>
</div>

<div class="body">
    <div class="item">
        ip :<input typ="text" id="ip" value="<?php echo $config['ip'] ?>">
    </div>

    <div class="item">
         端口:<input typ="text" id="port" value="<?php echo $config['port'] ?>">
    </div>

    <div class="ge_button" id="save" style="margin-left:250px;">
         保存
    </div>

    <div style="width:300px;margin-left: auto;margin-right: auto;margin-top:30px;margin-bottom:20px;font-size:18px;color:#ff1315;text-align: left">
        *端口设置为服务器启动端口<br>
        *ip为服务器ip
    </div>

    <code id="result">
    </code>


</div>

</body>
</html>