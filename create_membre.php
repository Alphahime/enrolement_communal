<?php
require_once "config.php";
require_once "membre.php"; // Assurez-vous d'inclure le fichier membre.php

if (isset($_POST["submit"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tranche_age = $_POST["tranche_age"];
    $sexe = $_POST["sexe"];
    $situation_matrimoniale = $_POST["situation_matrimoniale"];
    $statut = $_POST["statut"];
    $adresse = $_POST["adresse"];

    // Instanciez la classe Membre
    $membre = new Membre($connexion);

    // Utilisez la méthode addMember pour ajouter le membre
    $membre->addMember($nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse);
}
?>


