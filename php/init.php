<?php 
// session_start();
class ConnexionDb{
    
    public $codb;
    public $sql; 
    public $print;
    
    public function __construct(){ // s'active automatiquement en debut de class
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

    public function __destruct(){ // s'active automatiquement en fin de class
        try{
            $query=$this->codb->query($this->sql);
            $this -> print=$query->fetchall();
            // echo "<pre>",print_r($this -> print),"</pre>" ;
            $this->codb = null;
        }
        catch(PDOException $e)
        {
            
            echo "Message d'erreur : " .$e->getMessage(). "<br />";   
        }
    }
    
    // select
        public function SelectTb(){
            $this ->sql = "SHOW TABLES";
        }
    
        public function SelectCl($tbname){
            $this->sql = "SHOW COLUMNS FROM $tbname";
            echo $this->sql;
        }
        
        public function SelectRow($tbname,$colonne,$value){
            $this->sql = "SELECT * FROM $tbname WHERE $colonne='$value'";
        }

    // création
    public function CreateTb($tbname){
        $this ->sql = "CREATE TABLE IF NOT EXISTS $tbname(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)";
    }

    public function CreateCl($tbname,$colonne,$type){
        $this->sql = "ALTER TABLE $tbname ADD $colonne $type";
    }
    
    public function CreateRow($tbname,$colonne,$value){
        $newColonne='';
        $newValue='';
        for($i=0;$i<count($colonne);$i++){
            $newColonne .= $colonne[$i].",";
        }
        for($i=0;$i<count($value);$i++){
            $newValue .= "'". $value[$i]."',";
        }
        $newColonne = substr($newColonne, 0, -1);
        $newValue = substr($newValue, 0, -1);
        echo $newColonne ,"<br>";
        $this->sql = "INSERT INTO $tbname($newColonne)
            VALUES ($newValue)";
    }
    
    //Suppression
    public function SupTb($tbname){
        $this ->sql = "DROP TABLE $tbname";
    }
    
    public function SupCl($tbname,$colonne){
        $this->sql = "ALTER TABLE $tbname DROP $colonne";
    }

    // public function SupRow($tbname,$colonne,$value){
    //     $this->sql = "UPDATE $tbname
    //     SET $colonne = ''
    //     WHERE $colonne = $value";
    // }
}

// ---------------------------------------------------------------

$SelectDb = new ConnexionDb; // A utiliser pour supprimer

$SelectDb -> SelectTb();  // une Table
// $SelectDb -> print;
echo "<pre>",print_r($SelectDb -> print),"</pre>" ;

// $SelectDb -> SelectCl("wen");  // une Colonne

// $SelectDb -> SelectRow("gites","Nom","chambre");  // une Valeur
// ---------------------------------------------------------------

// $ConnexionDb = new ConnexionDb; // A utiliser pour creer
// $ConnexionDb -> CreateTb("wen");  // une Table

// $ConnexionDb = new ConnexionDb; // A utiliser pour creer
// $ConnexionDb -> CreateCl("wen","age","VARCHAR(40)");  // une Colonne

// $colonne= array(
// "Nom",
// "Description",
// "Photos",
// "Couchages	",
// "SallesDeBain",
// "Emplacement	",
// "Prix",
// "Disponibilite"
// );
// $value= array(
//     "cave",
//     "50m2",
//     "x",
//     "2",
//     "2",
//     "en Bas",
//     "350",
//     "Dispo"
//     );

// $ConnexionDb = new ConnexionDb; // A utiliser pour creer
// $ConnexionDb -> CreateRow("gites",$colonne,$value);  // une Ligne

// ---------------------------------------------------------------

// $ConnexionDb = new ConnexionDb; // A utiliser pour supprimer
// $ConnexionDb -> SupTb("wen");  // une Table

// $ConnexionDb = new ConnexionDb; // A utiliser pour supprimer
// $ConnexionDb -> SupCl("wen","age","VARCHAR(40)");  // une Colonne

// $ConnexionDb = new ConnexionDb; // A utiliser pour supprimer
// $ConnexionDb -> SupVl("gites","Nom",null);  // une Valeur
?>