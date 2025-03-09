<?php 

// Définition des paramètres de la base de données
$dbName = "database";
$username = "root";
$password = "";
$ipAdress = "localhost";

// Connection à la base de donnée et stockage variable en local
$instance = new PDO("mysql:host=$ipAdress;dbname=$dbName", $username, $password);

// Récupération de la connection à la base de données
function getDatabase(){
    global $instance;
    return $instance;
}


function checkIfValueUsed($tableName, $col, $value){
    global $instance;
    // Préparation requête SQL pour cheque si dans un table un valeur est déjà utiliser dans un certaine colonne
    $stmt = $instance->prepare("SELECT * FROM ".$tableName." WHERE ".$col." = %value%");

    // Remplacement des variables dans la requête
    $stmt->bindParam('%value%', $value);

    // Execution de la requête SQL
    $stmt->execute();
    // Fetch -> récup de la plremière ligne ou la requête est OK
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si une ligne est retournée (donc username associé au password)
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getAllLines($tableName){
    global $instance;
    // Préparation requête SQL pour récupérer toutes les lignes de la table
    $stmt = $instance->prepare("SELECT * FROM ".$tableName);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
?>