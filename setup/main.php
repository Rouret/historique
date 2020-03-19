<?php
    session_start();
    //Verifie si l'user a bien valider la connexion
    if(!isset($_SESSION["connexionDb"])){
        header("Location: ./setup.php");
        die();
    }
    require_once "../php/File.php";
    require_once "../php/db.php";
    $host=$_SESSION["host"];
    $dbname=$_SESSION["dbname"];
    $username=$_SESSION["username"];
    $password=$_SESSION["password"];

    //Sauvegarde les données de la base de données dans un fichier
    $data=array(
        "host"=>$host,
        "dbname"=>$dbname,
        "username"=>$username,
        "password"=>$password
    );
    $file=new File("../config/database.txt");
    $file->writeArray($data);
    //On initialise la base de données
    $db=new DB();
    if($db->setup()){
        echo "Done";
        header("Location: ../home");
    }else{
        echo "Erreur or Database is already done";
    }
?>