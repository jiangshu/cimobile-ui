<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jiangshuguang
 * Date: 13-3-29
 * Time: 下午6:55
 * To change this template use File | Settings | File Templates.
 */

?>
<html>
<head>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="./static/css/common.css"/>
    <link type="text/css" rel="stylesheet" href="./static/css/filter.css"/>
    <script type="text/javascript" src="./static/js/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="./static/js/filter.js"></script>
</head>
<body>
<div class="header">
    <div class="logo"></div>
    <div class="nav">
        <ul>
            <a href="index.php"><li>全部</li></a>
            <a href="filter.php"><li style="background-color: #ffffff;color:#000000">过滤</li></a>
            <a href="config.php"><li>配置</li></a>
        </ul>
    </div>
</div>

<div class="body">
    <div class="filter_content">
         <div id="condition">
              <div class="lTitle">
                  参数列表
              </div>
              <div>
                  <ul>
                      <li>
                          <h3>命令类型</h3>
                          <h4>打开浏览器</h4>
                      </li>
                      <li>
                          <h3>系统版本</h3>
                          <input type="checkbox" id="v2_2_0" value="2\.2\.0" class="sysVersion">2.2.0
                          <input type="checkbox" id="v2_2_1" value="2\.2\.1" class="sysVersion">2.2.1
                          <input type="checkbox" id="v2_2_2" value="2\.2\.2" class="sysVersion">2.2.2
                          <input type="checkbox" id="v2_3_0" value="2\.3\.0" class="sysVersion">2.3.0
                          <input type="checkbox" id="v2_3_1" value="2\.3\.1" class="sysVersion">2.3.1
                          <input type="checkbox" id="v2_3_3" value="2\.3\.3" class="sysVersion">2.3.3
                          <input type="checkbox" id="v2_3_4" value="2\.3\.4" class="sysVersion">2.3.4
                          <input type="checkbox" id="v2_3_5" value="2\.3\.5" class="sysVersion">2.3.5
                          <input type="checkbox" id="v2_3_6" value="2\.3\.6" class="sysVersion">2.3.6
                          <input type="checkbox" id="v2_3_7" value="2\.3\.7" class="sysVersion">2.3.7
                          <input type="checkbox" id="v2_3_9" value="2\.3\.9" class="sysVersion">2.3.9
                          <input type="checkbox" id="v4_0_1" value="4\.0\.1" class="sysVersion">4.0.1
                          <input type="checkbox" id="v4_0_3" value="4\.0\.3" class="sysVersion">4.0.3
                          <input type="checkbox" id="v4_0_4" value="4\.0\.4" class="sysVersion">4.0.4
                          <input type="checkbox" id="v4_0_9" value="4\.0\.9" class="sysVersion">4.0.9
                          <input type="checkbox" id="v4_1_0" value="4\.1\.0" class="sysVersion">4.1.0
                          <input type="checkbox" id="v4_1_2" value="4\.1\.2" class="sysVersion">4.1.2
                          <input type="checkbox" id="v4_2_0" value="4\.2\.0" class="sysVersion">4.2.0
                          <input type="checkbox" id="v4_2_1" value="4\.2\.1" class="sysVersion">4.2.1
                          <input type="checkbox" id="v4_2_2" value="4\.2\.2" class="sysVersion">4.2.2
                          <input type="checkbox" id="v5_0_0" value="5\.0\.0" class="sysVersion">5.0.0
                          <input type="checkbox" id="v5_2_0" value="5\.2\.0" class="sysVersion">5.2.0
                      </li>
                      <li>
                          <h3>mobile型号</h3>
                          <input type="checkbox" id="mHTC" value="htc" class="mobileType">HTC
                          <input type="checkbox" id="mZTE" value="zte" class="mobileType">ZTE
                          <input type="checkbox" id="mHUAWEI" value="huawei" class="mobileType">HUAWEI
                          <input type="checkbox" id="mMOTOROLA" value="motorola" class="mobileType">MOTOROLA
                          <input type="checkbox" id="mSAMSUNG" value="samsung" class="mobileType">SAMSUNG
                          <input type="checkbox" id="mlenovo" value="lenovo" class="mobileType">lenovo
                          <input type="checkbox" id="mMEIZU" value="meizu" class="mobileType">MEIZU
                          <input type="checkbox" id="mDELL" value="dell" class="mobileType">DELL
                          <input type="checkbox" id="mLG" value="lg" class="mobileType">LG
                          <input type="checkbox" id="mCOOLPAD" value="coolpad" class="mobileType">COOLPAD
                          <input type="checkbox" id="mMI" value="mi" class="mobileType">MI
                          <input type="checkbox" id="mSONY" value="sony" class="mobileType">SONY
                      </li>
                      <li>
                          <h3>浏览器类型</h3>
                          <input type="checkbox" id="native" value="native" class="browserType">native
                          <input type="checkbox" id="uc" value="uc" class="browserType">uc
                          <input type="checkbox" id="QQ" value="QQ" class="browserType">QQ
                          <input type="checkbox" id="chrome" value="chrome" class="browserType">chrome
                          <input type="checkbox" id="opera" value="opera" class="browserType">opera
                      </li>
                      <li>
                          <h3>url</h3>
                          <input type="text" style="width:400px;border:1px solid #a09128" id="url" name="url_url"/>
                      </li>
                  </ul>
              </div>
         </div>
        <div id="result">
            <div class="lTitle">
                mobile列表
            </div>
            <div>
                <table width="100%" cellpadding="5" id="filterInfo">
                    <tr>
                        <td width="10%"></td>
                        <td width="20%">型号</td>
                        <td width="15%">版本</td>
                        <td width="20%">别名</td>
                        <td width="45%">浏览器列表</td>
                    </tr>
                </table>
            </div>

            <div style="width:100%;margin-top:20px;text-align:right;margin-right:30px;">
                <input type="button" value="执行" id="execute1" class="ge_button" style="margin-right:20px;">
            </div>
        </div>

    </div>

    <div id="log">
        <div class="control"></div>
        <div class="content">
            <ul>
            </ul>
        </div>
    </div>
</div>



</body>
</html>