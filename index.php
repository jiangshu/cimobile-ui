<html>
  <head>
      <meta charset="utf-8"/>
      <link type="text/css" rel="stylesheet" href="./static/css/common.css"/>
      <link type="text/css" rel="stylesheet" href="./static/css/index.css"/>
      <script type="text/javascript" src="./static/js/jquery-1.8.2.js"></script>
      <script type="text/javascript" src="./static/js/index.js"></script>
  </head>
  <body>
     <div class="header">
         <div class="logo"></div>
         <div class="nav">
             <ul>
                 <a href="index.php"><li style="background-color: #ffffff;color:#000000;">全部</li></a>
                 <a href="filter.php"><li>过滤</li></a>
                 <a href="config.php"><li>配置</li></a>
             </ul>
         </div>
     </div>

     <div class="body body_index">
         <table align="center" cellpadding="8" width="100%"   id="mobileList">
             <tr bgcolor="#dfdfdf">
                 <td width="5%">序号</td>
                 <td width="10%">mobile型号</td>
                 <td width="10%">系统版本</td>
                 <td width="10%">mobile别名</td>
                 <td width="65%">浏览器操作</td>
             </tr>
         </table>

     </div>

     <div class="update ge_button">更新</div>
     <div class="tip">
         命令执行成功
     </div>

  </body>
</html>