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
$tablePasswordCol = "PASSWORD";
$tableMailCol = "MAIL";
$tablePhoneCol = "PHONE";

// Def nom valeurs dans le form (id et name)
$varUserame = "_username";
$varPassword = "_password";
$varMail = "_mail";
$varPhone = "_phone";

// Check si les champs du form sont remplis
if(!empty($_POST[$varUsername]) && !empty($_POST[$varPassword]) && !empty($_POST[$varMail]) && !empty($_POST[$varPhone])) {
    // Set de variables des valeurs du form en local
    $formUsername = $_POST[$varUsername];
    $formPassword = $_POST[$varPassword];
    $formMail = $_POST[$varMail];
    $formPhone = $_POST[$varPhone];

    // Si aucune ligne de la table $tableName à la valeur $formUsername dans la colonne $tableUsernameCol
    if(!checkIfValueUsed($tableName,$tableUsernameCol,$formUsername)){
        // Création de la requête d'ajout de la ligne dans la table
        $stmt = $databse->prepare("INSERT INTO ".$tableName."VALUES (".
        $tableUsernameCol.", ".
        $tablePasswordCol.", ".
        $tableMailCol.", ".
        $tablePhoneCol.
        ") (".
        "%".$tableUsernameCol."%, ".
        "%".$tablePasswordCol."%, ".
        "%".$tableMailCol."%, ".
        "%".$tablePhoneCol."%".
        ")");

        // Remplacement des variables dans la requête
        $stmt->bindParam('%'.$tableUsernameCol.'%', $formUsername);
        $stmt->bindParam('%'.$tablePasswordCol.'%', $formPassword);
        $stmt->bindParam('%'.$tableMailCol.'%', $formMail);
        $stmt->bindParam('%'.$tablePhoneCol.'%', $formPhone);

        // Execution de la requête SQL
        $stmt->execute();

        // Redirection vers nouvelle page
        header('Location: main.php');
        exit();
    } else {

    }
}

// Destroy session si erreur synchro username password
session_destroy();

// Redirection vers page login avec message erreur
header("Location: index.php");
exit();

?>