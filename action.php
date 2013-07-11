<?php


class Command{
    private $argument;
    public function __construct(){
        $this->argument = "";
        if(isset($_POST["id"])&&$_POST["id"] ){
            $this->argument.= " id=".$_POST["id"];
        }
        if(isset($_POST["alias"])&&$_POST["alias"] ){
            $this->argument.= " alias=".$_POST["alias"];
        }
        if(isset($_POST["browser"])&&$_POST["browser"]){
            $this->argument.= " browser=".$_POST["browser"];
        }

        if(isset($_POST["url"])&&$_POST["url"]){
            $this->argument.= " url=".$_POST["url"];
        }
    }

    public function execute(){
        $config = include("./data/config.php");
        $cmd = "java -jar ./libs/CIMobile_Cmd.jar".
                " ip=".$config["ip"].
                " port=".$config["port"].
                " action=openBrowser".
                $this->argument;
        PassThru($cmd);
    }
}

$command = new Command();
$command->execute();