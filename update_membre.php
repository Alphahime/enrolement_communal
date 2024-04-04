<?php
require_once "config.php";
require_once "membre.php";

// Instanciation de la classe Database pour la connexion à la base de données
$database = new Database();
$connexion = $database->connect();

// Instanciation de la classe Membre
$membre = new Membre($connexion);

// Vérification si l'ID du membre est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupération des informations du membre
    $membreInfo = $membre->readMemberById($id);

    // Vérification si le formulaire de mise à jour a été soumis
    if (isset($_POST["submit"])) {
        // Récupération des données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $sexe = $_POST["sexe"];
        $situation_matrimoniale = $_POST["situation_matrimoniale"];
        $adresse = $_POST["adresse"];
        $matricule = $_POST["matricule"]; // Ajout du champ "Matricule"

        // Mise à jour des informations du membre
        $membre->updateMember($id, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse, $matricule);
    }
} else {
    // Redirection vers index.php si l'ID du membre n'est pas spécifié
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un membre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier un membre</h2>
    <form action="update_membre.php?id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $membreInfo['nom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $membreInfo['prenom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tranche_age">Tranche d'âge :</label>
            <input type="text" class="form-control" id="tranche_age" name="tranche_age" value="<?php echo $membreInfo['tranche_age']; ?>" required>
        </div>
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select class="form-control" id="sexe" name="sexe" required>
                <option value="Homme" <?php if ($membreInfo['sexe'] === 'Homme') echo 'selected'; ?>>Homme</option>
                <option value="Femme" <?php if ($membreInfo['sexe'] === 'Femme') echo 'selected'; ?>>Femme</option>
            </select>
        </div>
        <div class="form-group">
            <label for="situation_matrimoniale">Situation matrimoniale :</label>
            <input type="text" class="form-control" id="situation_matrimoniale" name="situation_matrimoniale" value="<?php echo $membreInfo['situation_matrimoniale']; ?>" required>
        </div>
        <div class="form-group">
            <label for="statut">Statut :</label>
            <select class="form-control" id="statut" name="statut" required>
                <option value="Chef de quartier" <?php if ($membreInfo['statut'] === 'Chef de quartier') echo 'selected'; ?>>Chef de quartier</option>
                <option value="Civile" <?php if ($membreInfo['statut'] === 'Civile') echo 'selected'; ?>>Civile</option>
                <option value="Badian Gokh" <?php if ($membreInfo['statut'] === 'Badian Gokh') echo 'selected'; ?>>Badian Gokh</option>
                <!-- Ajoutez d'autres options ici si nécessaire -->
            </select>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $membreInfo['adresse']; ?>" required>
        </div>
        <div class="form-group">
            <label for="matricule">Matricule :</label>
            <input type="text" class="form-control" id="matricule" name="matricule" value="<?php echo $membreInfo['matricule']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Enregistrer les modifications</button>
    </form>
</div>
</body>
</html>
