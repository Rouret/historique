<?php
    include_once("../php/db.php");  
    $db=new DB; 
    switch($_GET["query"]){
        case "new":
            if(isset($_GET["title"]) && isset($_GET["compagny"]) && isset($_GET["description"]) && isset($_GET["website"])){
                $sql="INSERT INTO Projects (name,compagny,description,website,refuser) VALUES ('".$_GET["title"]."','".$_GET["compagny"]."','".$_GET["description"]."','".$_GET["website"]."',".$db->getUserId().")";
                if($db->put($sql)){
                    echo json_encode(array("success"=>""));
                }else{
                    echo json_encode(array("error"=>"Internal error"));
                }          
            }else{
                echo json_encode(array("error"=>"All params are not set"));
            }
            break;
        case "get":
            $sql="SELECT name,compagny,description,website,idproject as id FROM Projects";
            $data=$db->get($sql);
            echo json_encode(array("data"=>$data));
            break;
        default:
            echo json_encode(array("error"=>"All params are not set"));
    }

?>