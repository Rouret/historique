<?php
    session_start();
    include_once("../php/db.php");  
    $db=new DB; 
    switch($_GET["query"]){
        case "new":
            if(isset($_GET["query"]) && isset($_GET["firstname"]) && isset($_GET["lastname"]) && isset($_GET["email"]) && isset($_GET["phone"])){
                if($db->isUserExist()){
                    $id=$db->getUserId();
                    $sql_change="UPDATE Users SET firstname = '".$_GET["firstname"]."',lastname = '".$_GET["lastname"]."',email = '".$_GET["email"]."',tel ='".$_GET["phone"]."' WHERE iduser = ".$id;      
                }else{
                    $sql_change="INSERT INTO Users(firstname,lastname,email,tel) VALUES ('".$_GET["firstname"]."','".$_GET["lastname"]."','".$_GET["email"]."','".$_GET["phone"]."');";;
                }
                if($db->put($sql_change)){
                    echo json_encode(array("success"=>""));
                }else{
                    echo json_encode(array("error"=>"Internal error"));
                }
            }else{
                echo json_encode(array("error"=>"All params are not set"));
            }
            break;
        case "get":
            $str="";
            if($db->isUserExist()){
                $data=$db->getUserInfo();
                $str=array("data"=>$data[0]);
            }else{
                $str=array("error"=>"No user set");
            }
            echo json_encode($str);
            break;
        default:
            echo json_encode(array("error"=>"All params are not set"));
    }

?>