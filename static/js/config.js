$(function(){

    $("#save").on("click",function(){
        var port = $("#port").val(),
            ip = $("#ip").val();
        $("#result").html("");

        if(!(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip))){
            $("#result").html("ip输入错误!");
            return;
        }

        if(!(/^\d{1,5}$/.test(port))){
            $("#result").html("端口输入错误!");
            return;
        }

        $.get("./conf.php",{
            port:port,
            ip:ip
        },function(data){
            $("#result").html(data);
            setTimeout(function(){
                $("#result").html("");
            },5000);
        });
    });
});