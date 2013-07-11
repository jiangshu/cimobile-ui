CIMobi
======

android持续集成框架


** 概述：
CIMobile提供了一种移动端的持续集成自动化测试框架，目前支持android系统，此工具可以实现 实时或定时的在多个测试mobile的不同浏览器同时执行case。
框架实现了自动统计mobile浏览器列表，自动获取mobile由于wifi环境变化或者异常造成的ip变化，根据条件刷选mobile，并能根据设置的url，启动对应的浏览器打开url对应的page。
此工具不仅适合前端的QA，同时也适合于web开发人员，可以给定url，启动特定mobile的特定浏览器，辅助开发。


** 工具的特色
  此工具能满足传统持续集成的需求，并且具有以下特色。
  （1） 自动寻找mobile上安装的浏览器，省去查找统计各mobile的安装的浏览器类型的步骤，工具提供的查看的功能。
  （2） 当mobile重连wifi，ip会重新自动分配，当ip变化了，不需要手动修改配置，CImobile会自动重新获取mobile的ip
  （3）可以根据条件（mobile型号、系统的版本、浏览器类型、app自动分配的id以及别名）刷选对应的mobile，方便灵活
  （4） 批量操作，只需要指定筛选条件和url，就可以在所有满足条件的mobile运行case。
  （5） 此工具同样适应于Fe开发人员，可以给定url，启动特定mobile的特定浏览器，一键搞定，不需要输入一大串的url，也不需要二维码。
  （6） 除了通过命令行的形式使用工作，同样提供ui的方式，简单方便。

** 基本原理
    服务端启动一个服务，监听某个端口。mobile端通过app主动连接服务器端，
    并且将自身的信息（ip、类型、系统版本等）信息主动提交给服务端服务端管理所有的当前在线的mobile。
    服务器端接收命令（纯命令 or ui），将命令转发给目标mobile，目标mobile中的啊app接收命令并执行命令。

** 使用方法：

1. 下载&安装&配置手机app
    （1）在下载页通过链接直接下载或者通过二维码下载CIMobi.apk,并安装
    （2）对app进行配置
         服务器IP：即2中监听的服务器的IP
         端口：可以使用默认端口，也可以根据2中的服务器监听端口配置
         机器别名：最好取易识别的唯一的别名
    （3）配置好后先保存，然后通过点击连接，然后log中显示“服务器连接成功”则可以正常使用，如果连接不成功会有相应的提示

2.启动监听服务器
     （1）下载CIMobile_Server.jar，通过java -jar CIMobile_Server.jar 启动监听服务器
          默认的端口为3204，如果需要改变端口，可以通过阐述 port=8801指定
     （2）同级目录的log文件可以查看系统日志，包括连接的状态及命令的执行情况等

3.执行命令
  执行命令分两种情况：
  (1) 纯命令行形式：
      java -jar CIMobile_Cmd.jar
            ip=172.22.184.118       //监听服务器的ip
            port=3204               //监听服务器监听的端口
            action=openBrowser      //命令的类型目前只支持openBrowser类型
            browser=native&chrome   //浏览器类型
           【androidVersion=4.2.2 mobileType=htc  id=123 alias=mobile】 //可选项，组合的筛选条件
            isAll=true              //命令是否作用在所有满足刷选条件的mobile上
            url=http://www.163.com  //浏览器启动的url
  （2）ui方式
      a."全部“page中有所有的当前可操作的的mobile，选择浏览器，然后填入url，单击“启动”按钮，就可以启动相应的浏览器
      b."过滤“page可以通过条件的组合刷选出满足条件的mobile，然后可以进行相应的动作。

  *注：如果在CI中使用此工具，可以通过写以一个shell脚本执行命令行执行，或者通过其它形式执行配置参数执行命令行即可。

** 使用场景：
   1.FE开发
    a.单选方式：选择浏览器，然后填入url，单击“启动”按钮，就可以启动相应的浏览器
    b.多选（筛选）方式：条件的组合刷选出满足条件的mobile，然后填入url执行启动操作

   2.持续集成模式引入
     （1）php测试框架
       $cmd = "java -jar CIMobile_Cmd.jar ip=172.22.184.118 port=3204 action=openBrowser alias=mobile1  browser=uc&native url=http://www.baidu.com";
        PassThru($cmd);
     （2）shell方式
java -jar CIMobile_Cmd.jar ip=172.22.184.118 port=3204 action=openBrowser alias=mobile1  browser=uc&native url=http://www.baidu.com
  ** 后续完善计划
  1.截图：
     通过观察程序运行的中间状态，往往也是一种确定程序正确性的方法，后续计划能自由控制或者通过设置时间间隔截取屏幕，并且能保存截图图片，
     方面查看。
  2.js通知，任务调度
     android前端只能有一个程序运行，所以不能同时在多浏览器运行case，但可以串行在浏览器中运行case，在所有case跑完后，
     往往可以通过js发送一个结束的消息，后续计划在app上接收js发出的消息，智能调度其它浏览器，满足多浏览串行运行case的需求；






（2）window下可以直接通过以下几步手动完成
a.下载
CIMobile_Server.jar ：http://10.48.30.87:8088/cimobi/CiMobile/libs/CIMobile_Server.jar
CIMobile_Cmd.jar ：http://10.48.30.87:8088/cimobi/CiMobile/libs/CIMobile_Cmd.jar
b.启动服务器
java -jar CIMobile_Server.jar port=8012
同样可以通过日志查看log文件，如果提示“service start success” ，说明服务启动成功。


3.执行命令
（1)linux下可以直接执行1中下载的cmd.sh脚本修改alias配置，为2中app设置的别名
 (2)windows下可以直接执行以下命令,同样修改alias配置，为2中app设置的别名
  java -jar CIMobile_Cmd.jar action=openBrowser ip=127.0.0.1 port=8011 alias=mobile2 browser=uc@native url=http://www.baidu.com
 至此,如果mobile中会依次打开uc和native浏览器，并且打开的url为http://www.baidu.com，恭喜你，配置和简单使用都已经成功


//如果mobile中没有安装指定的浏览器，必须要过滤掉，bug

5.高级使用
在4中第三步，我们通过以下方式执行启动命令
java -jar CIMobile_Cmd.jar action=openBrowser ip=127.0.0.1 port=8011 alias=mobile2 browser=uc@native url=http://www.baidu.com
其中
action=openBrowser：指定命令的类型为启动浏览器
ip=127.0.0.1：指定服务器的ip，如果命令的发送主机和服务器在同一主机，可以指定为127.0.0.1
port=8011：指定服务器的监听端口
alias=mobile2：刷选条件，筛选出别名为mobile2的mobile，也就是命令的作用对象
browser=uc@native：需要打开哪些浏览器，这里为uc浏览器和原生浏览器
url=http://www.baidu.com：指定浏览器启动的url为http://www.baidu.com


除快速体验介绍的使用方式之外，cimobi还包括一些高级的使用方式：
1.强大的筛选能力
   （1）唯一指定mobile：
        可以通过id和alias唯一指定mobile，如果两者都指定了，id指定方式的优先级高于alias方式，id为app自动分配的，可以从app中系统信息中查看
        例如
        java -jar CIMobile_Cmd.jar action=openBrowser ip=127.0.0.1 port=8011 id=6fc37847a9d browser=uc@native url=http://www.baidu.com
        命令的意思是在打开id为6fc37847a9d的uc和native浏览器，并且url设定为http://www.baidu.com
   （2）模糊刷选
        模糊刷选的条件有：
        -- androidVersion android系统的版本（例如：2.3）
        -- mobileType mobile的型号 （例如：HTC）
        -- browser 选择的浏览器列表 browser一方面可以作为启动的浏览器类表，同时也是刷选条件，mobile中必须安装了全部指定的浏览器，才能命中筛选
        java -jar CIMobile_Cmd.jar action=openBrowser ip=127.0.0.1 port=8011 androidVersion=4.0.4 mobileType=htc browser=uc@native url=http://www.baidu.com
        命令的意思是在筛选出系统版本为4.0.4、mobile的类型为htc，并且安装uc和native浏览器的mobile，打开uc和native浏览器，url设定为http://www.baidu.com
        如果要所有满足筛选条件的mobile都执行命令，cimobi还提供了一个参数isAll,
        -- isAll 如果指定isAll=true，那么所有满足刷选条件的mobile都会执行命令

2.启动多个浏览
    如果想在一个mobile上启动的多个浏览器，例如设置命令参数browser=uc@native，有两种方式启动浏览器，一种是同时启动指定的浏览器，另一种是按顺序启动。
    (1)默认为同时启动
    (2)如果想顺序启动，cimobi提供js驱动的方式，如果想在某个时刻启动下一个浏览器，只需要发送一个请求，app接收这个请求，驱动启动下一个浏览器
    $.get("http://127.0.0.1:8011",{action:"over"},function(data){});
    app同样会监听一个端口，这个端口与服务器设定的端口一致，当接收js的请求，app会启动下一个浏览器

3.ui方式






      * %ATTACHURL%/cimobi.png
   * （2）对app进行配置
      * a.服务器IP：即2中监听的服务器的IP
      * b.端口：可以使用默认端口，也可以根据2中的服务器监听端口配置
      * c.机器别名：最好取易识别的唯一的别名，用于区分不同手机
      * %ATTACHURL%/img2.jpg
   * （3）配置好后先保存，然后通过点击连接，然后log中显示“服务器连接成功”则可以正常使用，如果连接不成功会有相应的提示

*2.启动监听服务器*
   * （1）下载CIMobile_Server.jar
      * a.点击下载  http://10.48.30.87:8088/cimobi/CiMobile/libs/CIMobile_Server.jar
      * b.命令下载
  <pre>
wget http://10.48.30.87:8088/cimobi/CiMobile/libs/CIMobile_Server.jar
</pre>
   * （2）通过以下命令 启动监听服务器
  <pre>
java -jar CIMobile_Server.jar prot=8080
</pre>
      * 默认的端口为3204，如果需要改变端口，可以通过阐述 port=8080指定
   * （3）同级目录的log文件可以查看系统日志，包括连接的状态及命令的执行情况等

*3.执行命令*
   * (1)下载执行命令的包
      * a.点击下载  http://10.48.30.87:8088/cimobi/CiMobile/libs/CIMobile_Cmd.jar
      * b.命令下载
  <pre>
 wget http://10.48.30.87:8088/cimobi/CiMobile/libs/CIMobile_Cmd.jar
</pre>

   * (2) 纯命令行形式：
  <pre>
java -jar CIMobile_Cmd.jar ip=172.22.184.118 port=3204 action=openBrowser 【sequence=aync androidVersion=4.2.2 mobileType=htc  id=123 alias=mobile browser=uc@native】 isAll=true url=http://www.baidu.com
</pre>
      * @ ip=172.22.184.118       //监听服务器的ip
      * @ port=3204               //监听服务器监听的端口
      * @ action=openBrowser      //命令的类型目前只支持openBrowser类型
      * @ browser=native&chrome   //浏览器类型
      * @【androidVersion=4.2.2 mobileType=htc  id=123 alias=mobile browser=uc&native】 //可选项，组合的筛选条件
      * -------- androidVersion android系统的版本
      * -------- mobileType mobile的型号
      * -------- id 系统自动分配的id，可在app查看
      * -------- alias mobile别名，可配置
      * -------- browser 选择的浏览器列表
      * -------- sequence 如果需要在同一个mobile上打开多个浏览器，有两种方式，一种是通过通过同步的方式（默认方式），另一种是异步的方式，设置 sequence=aync，通过js发送启动请求，启动后续浏览器，所有的浏览器按先后顺序启动。
      * @ isAll=true              //命令是否作用在所有满足刷选条件的mobile上
      * @ url=http://www.163.com  //浏览器启动的url

   * （3）ui方式
       http://10.48.30.87:8088/cimobi/CiMobile
      * a."全部“page中有所有的当前可操作的的mobile，选择浏览器，然后填入url，单击“启动”按钮，就可以启动相应的浏览器
      * b."过滤“page可以通过条件的组合刷选出满足条件的mobile，然后可以进行相应的动作。



---++5.一键安装及使用说明

*1.无界面的方式*
   * （1）这个方式用于在命令行下执行case，无操作界面，适用于CI任务或不需要界面管理手机连接状态的情况
   * （2）直接执行下列命令，会自动自动jar包，并启动服务（会提示输入端口）。只能通过命令使用，满足持续集成需求。
  <pre>
wget http://10.48.30.87:8088/cimobi/repos/start.sh && sh start.sh
</pre>


*2.有界面的方式*
   * （1）与上一种方式不同，这个下载包中包含了页面，可对当前连接服务器的<strong>测试机进行管理，也可以进行任务的调度，具有可视化使用方便的优点</strong>。
   * （2）直接执行下列命令，会自动自动jar包及ui所需的js和php文件，并启动服务（会提示输入端口）。不仅能通过命令使用，满足持续集成需求。而且能通过界面使用，满足手工测试需求。
  <pre>
wget http://10.48.30.87:8088/cimobi/repos/ui.sh && sh ui.sh
</pre>

---++6.使用场景
*（1）fe辅助开发*
   *  a.单选方式：选择浏览器，然后填入url，单击“启动”按钮，就可以启动相应的浏览器
%ATTACHURL%/img4.jpg
   * 多选（筛选）方式：条件的组合刷选出满足条件的mobile，然后填入url执行启动操作
%ATTACHURL%/img3.jpg
*（2）持续集成模式引入*
   * a.php方式
  <pre>
$cmd = "java -jar CIMobile_Cmd.jar ip=172.22.184.118 port=3204 action=openBrowser alias=mobile1  browser=uc&native url=http://www.baidu.com";
PassThru($cmd);
</pre>
   * a.shell方式
  <pre>
java -jar CIMobile_Cmd.jar ip=172.22.184.118 port=3204 action=openBrowser alias=mobile1  browser=uc&native url=http://www.baidu.com
</pre>









