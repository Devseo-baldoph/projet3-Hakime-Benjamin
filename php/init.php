<?php 
session_start();

class ConnexionPhpMyAdmin{
    private $servername;
    private $username;
    private $password;
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
            $codb = new ConnexionPhpMyAdmin("localhost","root","");
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)";
            $codb->codb->exec($sql);
            $codb = null;
        }
        catch(PDOException $e)
        {
            
            echo "Message d'erreur : " .$e->getMessage(). "<br />";   
        }
    }
}

// ---------------------------------------------------------------------------------------------------------------------------

class ConnexionDb{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public $codb;
    public function __construct(string $servername,string $username, $password, string $dbname){
        try{
            $this -> servername = $servername;
            $this -> username = $username;
            $this -> password = $password;
            $this -> dbname = $dbname;
            $codb = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,[
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

// ---------------------------------------------------------------

class CreateTb{
    public function Create($dbname,$tbname){
        try{
            $codb = new ConnexionDb("localhost","root","",$dbname);
            $sql = "CREATE TABLE IF NOT EXISTS $tbname(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)";
            $codb->codb->exec($sql);
            $codb = null;
        }
        catch(PDOException $e)
        {
            
            echo "Message d'erreur : " .$e->getMessage(). "<br />";   
        }
    }
}


// $CreateDb = new CreateDb; // A utiliser pour Creer
// $CreateDb -> Create("nomDeMaBaseDeDonnee");  // une base de donnée

// $CreateTb = new CreateTb; // A utiliser pour creer
// $CreateTb -> Create("nomDeMaBaseDeDonnee","nomDeMaTable");  // une Table

?>