<?php
require_once "config.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    try {
        // Préparation de la requête de suppression
        $sql = "DELETE FROM Membres WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Redirection vers la page principale après la suppression
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        // Gestion des erreurs PDO
        die("Erreur lors de la suppression du membre : " . $e->getMessage());
    }
} else {
    // Redirection si l'ID n'est pas défini
    header("Location: index.php");
    exit();
}
?>
