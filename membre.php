<?php
require_once "config.php";
require_once "crud.php";


class Membre implements Crud { 

    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function addMember($nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse) {
        try {
            // Préparation de la requête d'insertion
            $sql = "INSERT INTO Membres (nom, prenom, tranche_age, sexe, situation_matrimoniale, statut, adresse) VALUES (:nom, :prenom, :tranche_age, :sexe, :situation_matrimoniale, :statut, :adresse)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $stmt->bindParam(":tranche_age", $tranche_age, PDO::PARAM_INT);
            $stmt->bindParam(":sexe", $sexe, PDO::PARAM_STR);
            $stmt->bindParam(":situation_matrimoniale", $situation_matrimoniale, PDO::PARAM_STR);
            $stmt->bindParam(":statut", $statut, PDO::PARAM_STR);
            $stmt->bindParam(":adresse",$adresse, PDO::PARAM_STR);
            $stmt->execute();

            
            header("location: index.php");
            exit();

        } catch (PDOException $e) {
            // Gestion des erreurs de base de données
            die("Erreur lors de l'ajout du membre : " . $e->getMessage());
        }
    }

    public function readMember() {
        try {
            // Récupération de tous les membres depuis la base de données
            $sql = "SELECT * FROM Membres";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;

        } catch (PDOException $e) {
            // Gestion des erreurs de base de données
            die("Erreur lors de la lecture des membres : " . $e->getMessage());
        }
    }

    public function updateMember($id, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse) {
        try {
            // Préparez et exécutez la requête de mise à jour
            $sql = "UPDATE Membres SET nom = :nom, prenom = :prenom, tranche_age = :tranche_age, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale, statut = :statut, adresse = :adresse WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $stmt->bindParam(":tranche_age", $tranche_age, PDO::PARAM_INT);
            $stmt->bindParam(":sexe", $sexe, PDO::PARAM_STR);
            $stmt->bindParam(":situation_matrimoniale", $situation_matrimoniale, PDO::PARAM_STR);
            $stmt->bindParam(":statut", $statut, PDO::PARAM_STR);
            $stmt->bindParam(":adresse", $adresse, PDO::PARAM_STR);
            $stmt->execute();

            // Redirection vers index.php après la mise à jour
            header("location: index.php");
            exit();

        } catch (PDOException $e) {
            // Gestion des erreurs de base de données
            die("Erreur lors de la mise à jour du membre : " . $e->getMessage());
        }
    }

    public function deleteMember($id) {
        try {
            // Préparez et exécutez la requête de suppression
            $sql = "DELETE FROM Membres WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            // Redirection vers index.php après la suppression
            header("location: index.php");
            exit();

        } catch (PDOException $e) {
            // Gestion des erreurs de base de données
            die("Erreur lors de la suppression du membre : " . $e->getMessage());
        }
    }

    public function readMemberById(){
        
    }
}
?>
