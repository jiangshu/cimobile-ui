$(function(){
    GE  = "GE" in window? window.GE : {};

    $.ajax({
        type:"get",
        dataType:"json",
        url:"./MobiInfo.php?type=2",
        success:function(data){
            mobileInfo = data;
        }});


   String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) {
        if (!RegExp.prototype.isPrototypeOf(reallyDo)) {
            return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi": "g")), replaceWith);
        } else {
            return this.replace(reallyDo, replaceWith);
        }
    };

    var regComb = function(regA,regB){
        var regs = [], i,j;
        if(isFull(regA) && isFull(regB)){
            for(i=0;i<regA.length;i++){
                for(j=0;j<regB.length;j++){
                    regs.push(regA[i]+","+regB[j]);
                }
            }
        }
        return regs;
    },

    isFull = function(array){
        return !!(array.length>0)?true:false;
    };



  /*
   *筛选事件中心
   * */
   var filterEvent = function(){
       var mobile=[],version=[],browser=[],i;
       $.each($(".sysVersion"),function(key,el){
           if($(el).attr("checked")){
               version.push($(el).val());
           }
       });
       $.each($(".mobileType"),function(key,el){
           if($(el).attr("checked")){
               mobile.push($(el).val());
           }
       });
       $.each($(".browserType"),function(key,el){
           if($(el).attr("checked")){
               browser.push($(el).val());
           }
       });
       var browser_bak = [];
       if(!isFull(mobile) && !isFull(version)){
           $("#filterInfo").children().remove();
           return;
       }
       if(isFull(mobile)){
           var mobile_b = [];
           for(i=0;i<mobile.length;i++){
               mobile_b.push("[^,]*"+mobile[i]+"[^,]*");
           }
           mobile = mobile_b;
       }else{
           mobile.push("[^,]*");
       }

       if(!isFull(version)){
           version.push("[^,]*");
       }

       if(isFull(browser)){
           var browser_b = [];
           for(i=0;i<browser.length;i++){
               browser_b.push("[^,]*"+browser[i]);
               browser_bak.push(browser[i]);
           }
           browser = browser_b;
       }else{
           browser.push("[^,]*");
       }

       var conditions = regComb(regComb(mobile,version),browser);
       var satMobileList = getMobile(conditions,browser_bak);
       displayMobileList(satMobileList);
   };

   /*
    *  获取筛选结果
    * */
    var getMobile = function(conditions,browser){
        var satMobileList = {};
        var condition = "";
        var reg;
        for(var i=0;i<conditions.length;i++){
            condition = conditions[i];
            reg = new RegExp(condition,"gi");
            $.each(mobileInfo,function(alias,info){
                 if(reg.test(info)){
                     var infoArr = info.split(",");
                     if(!isFull(browser)){
                         if(!(alias in satMobileList)){
                             satMobileList[alias] = {};
                             satMobileList[alias]["alias"] = alias;
                             satMobileList[alias]["type"]=infoArr[0];
                             satMobileList[alias]["version"]=infoArr[1];
                             satMobileList[alias]["browser"]=infoArr[2].replace(/@/g," ");
                         }
                     }else{
                         condition = condition.replace(/\[\^,\]\*/g,"");
                         var argArr = condition.split(",");
                         var bro = argArr[argArr.length -1];
                         if(alias in satMobileList){
                             satMobileList[alias]["browser"]+= " "+bro;
                         }else{
                             satMobileList[alias] = {};
                             satMobileList[alias]["alias"] = alias;
                             satMobileList[alias]["type"]=infoArr[0];
                             satMobileList[alias]["version"]=infoArr[1];
                             satMobileList[alias]["browser"]=bro;
                         }
                     }
                 }
            })
        }
      return satMobileList;
    };

   /*
    *显示mobile信息
    * */
    var displayMobileList = function(satMobileList){
        var tpl  = function(alias,type,version,browser){
            return "<tr>" +
                "<td><input type='checkbox' data_browser='"+browser+"' data_alias='"+alias+"' class='filterResult' checked/></td>" +
                "<td>"+type+"</td>" +
                "<td>"+version+"</td>" +
                "<td>"+alias+"</td>" +
                "<td>"+browser+"</td>" +
                "/<tr>" ;
        };
        var html =" <tr>" +
            "<td width='10%'></td>" +
            "<td width='20%'>型号</td>" +
            "<td width='15%'>版本</td>" +
            "<td width='20%'>别名</td>"+
            "<td width='45%'>浏览器</td>" +
            "</tr>";

        $("#filterInfo").children().remove();
        $("#filterInfo").append(html);

        $.each(satMobileList,function(alias,satMobile){
            $("#filterInfo").append(tpl(satMobile["alias"],satMobile["type"],satMobile["version"],satMobile["browser"]));
        })
    };
    $(".sysVersion").on("click",filterEvent);
    $(".mobileType").on("click",filterEvent);
    $(".browserType").on("click",filterEvent);


    /*
     * 注册执行事件
     * */
    $("#execute1").on("click",function(){
           if( $("#url").val() == ""){
               addLog("url不能为空");
               return;
           }
           var filterResult = [];
           $.each(($(".filterResult")),function(key,mobileInstance){
                if($(mobileInstance).attr("checked")){
                    var browserArr =$(mobileInstance).attr("data_browser").split(" ");
                    var browsers = "";
                    if(browserArr.length == 1){
                        browsers = browserArr[0];
                    }else{
                        browsers = browserArr.join("@");
                        if(browsers.slice(-1)=="@"){
                            browsers = browsers.slice(0,-1);
                        }
                    }
                    filterResult.push({
                        alias:$(mobileInstance).attr("data_alias"),
                        browser:browsers,
                        url:$("#url").val()
                    });
                }
           });

        var sendCommand = function(sendData){
            addLog("正在打开浏览器...");
            $.post("./action.php",sendData,function(data){
                addLog(data);
            });
        };

        var index = 0;
        if(filterResult.length>0){
            sendCommand(filterResult[index]);
            index++;
            if(index<filterResult.length){
                var excuteInterval = setInterval(function(){
                    if(index<filterResult.length){
                        sendCommand(filterResult[index]);
                        index++;
                    }else{
                        clearInterval(excuteInterval);
                    }
                },50);
            }
        }else{
            addLog("没有选择mobile");
        }
    });

   /*
    *打印日志
    * */
    var addLog = function(log){
         $("#log ul").append("<li>"+(new Date())+":  "+log+"</li>");
    };

    var setLogPositon = function(){
        $("#log").css("display","none");
        var top = $(".body #condition").offset().top;
        var height = $(".body #condition").height();

        if(top + height + 110 >$("body").height()){
            $("#log").css("top",top+height+20);
        }else{
            $("#log").css("top",$("body").height()-115);
        }
        $("#log").css("display","block");
    };

    $(window).on("resize",function(){
        setLogPositon();
    });
    setLogPositon();
});
