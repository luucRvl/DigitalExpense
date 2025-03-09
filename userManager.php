<?php 

session_start();
require_once("database.php");

$database = getDatabase();

function addUser(){
    
}
function removeUser(){

}

class User {
    // Propriétés privées
    private $uuid;
    private $name;
    private $email;
    private $age;

    private $database;

    // Constructeur
    public function __construct($database, $name, $email, $age) {
        $this->database = $database;
        
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }

    // Récupération et Définition pour le nom
    public function getName() {return $this->name;}
    public function setName($name) {$this->name = $name;}

    // Récupération et Définition pour l'email
    public function getEmail() {return $this->email;}
    public function setEmail($email) {$this->email = $email;}

    // Récupération et Définition pour l'âge
    public function getAge() {return $this->age;}
    public function setAge($age) {$this->age = $age;}

    // Mettre à jour les informations de la base de données
    private function update(){

    }
}

?>