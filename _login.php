<?php

// Chargement session (récup valeurs form)
session_start();
// Chargement database si non fait
include_once("database.php");

// Récup connexion de database
$database = getDatabase();
// Définition du nom de la table pour les logins
$tableName = "table";
$tableUsernameCol = "USERNAME";
$tableMailCol = "MAIL";
$tablePhoneCol = "PHONE";

// Def nom valeurs dans le form (id et name)
$varUserame = "_username";
$varPassword = "_password";

// Check si les champs du form sont remplis
if(!empty($_POST[$varUsername]) && !empty($_POST[$varPassword])) {
    // Set de variables des valeurs du form en local
    $formUsername = $_POST[$varUsername];
    $formPassword = $_POST[$varPassword];

    // Préparationd de la requête SQL pour récup les lignes où username + password
    $stmt = $database->prepare("SELECT * FROM ".$tableName." WHERE USERNAME = %username% AND PASSWORD = %password%");

    // Remplacement des variables dans la requête
    $stmt->bindParam('%username%', $formUsername);
    $stmt->bindParam('%password%', $formPassword);

    // Execution de la requête SQL
    $stmt->execute();
    // Fetch -> récup de la plremière ligne ou la requête est OK
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si une ligne est retournée (donc username associé au password)
    if ($result) {

        // Set des variables dans la session pour passage inter-pages
        $_SESSION['username'] = $result[$tableUsernameCol];
        $_SESSION['mail'] = $result[$tableMailCol];
        $_SESSION['phone'] = $result[$tablePhoneCol];

        // Redirection vers nouvelle page
        header('Location: main.php');
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Destroy session si erreur synchro username password
session_destroy();

// Redirection vers page login avec message erreur
header("Location: index.php");
exit();

?>