<?php 
session_start();
class ConnexionDb{
    public $codb;
    public $sql; 
    public function __construct(){
        try{
            $codb = new PDO("mysql:host=localhost;dbname=gite", "root", "",[
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

    public function __destruct(){
        try{
            $this->codb->exec($this->sql);
            $this->codb = null;
        }
        catch(PDOException $e)
        {
            
            echo "Message d'erreur : " .$e->getMessage(). "<br />";   
        }
    }

    public function CreateTb($tbname){
        $this ->sql = "CREATE TABLE IF NOT EXISTS $tbname(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)";
    }

    public function CreateCl($tbname,$colonne,$type){
            $this->sql = "ALTER TABLE $tbname ADD $colonne $type";
    }
    
    public function CreateVl($tbname,$colonne,$value){
        $this->sql = "INSERT INTO $tbname($colonne)
            VALUES ('$value')";
    }
}

// ---------------------------------------------------------------

// $ConnexionDb = new ConnexionDb; // A utiliser pour creer
// $ConnexionDb -> CreateTb("test");  // une Table

// $ConnexionDb = new ConnexionDb; // A utiliser pour creer
// $ConnexionDb -> CreateCl("test","nom","VARCHAR(40)");  // une Colonne

// $ConnexionDb = new ConnexionDb; // A utiliser pour creer
// $ConnexionDb -> CreateVl("test","nom","hakime");  // une Valeur
?>