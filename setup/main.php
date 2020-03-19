<?php
    session_start();
    #Verifie si l'user a bien valider la connexion
    if(!isset($_SESSION["connexionDb"])){
        header("Location: ./setup.php");
        die();
    }
    require_once "../php/File.php";
    require_once "../php/db.php";
    //unset($_SESSION["connexionDb"]);
    $host=$_SESSION["host"];
    $dbname=$_SESSION["dbname"];
    $username=$_SESSION["username"];
    $password=$_SESSION["password"];

    $data=array(
        "host"=>$host,
        "dbname"=>$dbname,
        "username"=>$username,
        "password"=>$password
    );
    $file=new File("../config/database.txt");
    $file->writeArray($data);

    $db=new DB();
?>