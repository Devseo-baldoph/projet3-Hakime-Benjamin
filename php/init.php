<?php 
session_start();

class ConnexionDb{
    public $servername;
    public $username;
    public $password;
    public $codb;
    public function __construct(string $servername,string $username, $password){
        try{
            $this -> servername = $servername;
            $this -> username = $username;
            $this -> password = $password;
            $codb = new PDO("mysql:host=$servername", $username, $password,[
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
            $this -> codb = $codb;
            
        }
        catch(PDOException $e)
        {
            
            echo "Message d'erreur : " .$e->getMessage(). "<br />";
        }
    }
}

class CreateDb{
    public function Create($dbname){
        try{
            $codb = new ConnexionDb("localhost","root","");
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            $codb->codb->exec($sql);
            $codb = null;
        }
        catch(PDOException $e)
        {
            
            echo "Message d'erreur : " .$e->getMessage(). "<br />";   
        }
    }
}


$CreateDb = new CreateDb;
$CreateDb -> Create("wen");

?>