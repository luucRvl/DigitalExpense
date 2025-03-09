<?php 

// Chargement session (récup valeurs form)
session_start();
// Chargement database si non fait
include_once("database.php");

// Récup connexion de database
$database = getDatabase();

class FilterableArray extends ArrayObject {

    // Méthode de filtrage spécifique pour demandes de remboursement
    public function filterByParameter($key, $value) {
        $filtered = array_filter($this->getArrayCopy(), function($item) use ($key, $value) {
            return isset($item[$key]) && $item[$key] == $value;
        });
        return new static($filtered);
    }
}

?>