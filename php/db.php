<?php

require_once "File.php";
require "../config/setup_database.php";
class DB {
    private $pdo = null;
    private $stmt = null;
    private $class_param;
    function __construct(){   
        $file=new File("../config/database.txt");
        $temp=$file->read();
        if(strlen($temp)!=0){
            $this->class_param=$file->readArray();
            $this->connect();
        }
    }
    function connect(){
        try {
            $this->pdo = new PDO(
                "mysql:host=".$this->class_param->host.";dbname=".$this->class_param->dbname.";charset=utf8", 
                $this->class_param->username, $this->class_param->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (Exception $ex) { 
            die($ex->getMessage());
        }
    }
    function test($host,$dbname,$username,$password){
        $key=true;
        try {
            $this->pdo = new PDO(
                "mysql:host=".$host.";dbname=".$dbname.";charset=utf8", 
                $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (Exception $ex) {
            $key=false;
        }
        return $key;
    }
    function put($sql, $cond=null){
        $key=true;
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($cond);
        } catch (Exception $ex) {
            $key=false;
            error_log("Error PUT DB ".$ex,0);
        }
        $this->stmt = null;
        return $key;
    }
    function get($sql, $cond=null){
        $result = false;
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($cond);
            $result = $this->stmt->fetchAll();
        } catch (Exception $ex) {
            error_log("Error GET DB: ".$ex,0);
        }
        $this->stmt = null;
        return $result;
    }
    function setup(){
        //Cette varaible comporte toutes les requetes SQL a effectuer
        $l=count($GLOBALS["db_setup"]);
        $k=1;
        foreach ($GLOBALS["db_setup"] as $value) {
            try{
                $result=$this->pdo->prepare($value);
                $result->execute();
                $k++;
            }catch(PDOException $e){
                error_log("Erreur or Database is already done");
                break;
            }
        }
        //Vérification si il y a une erreur
        $key=false;
        if($k==$l+1){
            $key=true;
        }
        return $key;
    }
    function isUserExist(){
        $sql_verif="SELECT iduser FROM Users ";
        $data_verif=$this->get($sql_verif);
        $key=true;
        if(count($data_verif)==0){
            $key=false;
        }
        return $key;
    }
    function getUserId(){
        return $this->get("SELECT max(iduser) as iduser FROM Users")[0]["iduser"];
    }
    function getUserInfo(){
        return $this->get("SELECT firstname,lastname,email,tel FROM Users");
    }
    function __destruct(){
        if ($this->stmt!==null) { $this->stmt = null; }
        if ($this->pdo!==null) { $this->pdo = null; }
    }
}
?>