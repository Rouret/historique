<?php
    session_start();
    include_once("../php/db.php");
    if(isset($_GET["host"]) && isset($_GET["dbname"]) && isset($_GET["username"]) && isset($_GET["password"])){
        $db=new DB;
        if($db->test($_GET["host"],$_GET["dbname"],$_GET["username"],$_GET["password"])){
            #On definit un session qui nous de permet de bien verifier si l'user a rentré les bon param
            $_SESSION["connexionDb"]=true;
            $_SESSION["host"]=$_GET["host"];
            $_SESSION["dbname"]=$_GET["dbname"];
            $_SESSION["username"]=$_GET["username"];
            $_SESSION["password"]=$_GET["password"];
            echo json_encode(array("success"=>"ok"));
        }else{
            echo json_encode(array("error"=>"Can connect to this database"));
        }
    }else{
        echo json_encode(array("error"=>"All params are not set"));
    }
?>