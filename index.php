<?php
require_once "config.php";
require_once "membre.php";

// Instanciation de la classe Database pour la connexion à la base de données
$database = new Database();
$connexion = $database->connect();

// Instanciation de la classe Membre
$membre = new Membre($connexion);

// Traitement du formulaire
if (isset($_POST["submit"])) {
    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tranche_age = $_POST["tranche_age"];
    $sexe = $_POST["sexe"];
    $situation_matrimoniale = $_POST["situation_matrimoniale"];
    $statut = $_POST["statut"];
    $adresse = $_POST["adresse"];

    // Insertion des données dans la base de données
    $membre->addMember($nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des membres de la commune de Patte d'Oie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <!-- Formulaire pour créer un nouveau membre -->
    <h2>Créer un nouveau membre</h2>
    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="tranche_age">Tranche d'âge :</label>
            <input type="text" class="form-control" id="tranche_age" name="tranche_age" required>
        </div>
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select class="form-control" id="sexe" name="sexe" required>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
        </div>
        <div class="form-group">
            <label for="situation_matrimoniale">Situation matrimoniale :</label>
            <input type="text" class="form-control" id="situation_matrimoniale" name="situation_matrimoniale" required>
        </div>
        <div class="form-group">
        <label for="statut">Statut :</label>
            <select class="form-control" id="statut" name="statut" required>
                <option value="Chef de quartier">Chef de quartier</option>
                <option value="Civile">Civile</option>
                <option value="Badian Gokh">Badian Gokh</option>
                <!-- Ajoutez d'autres options ici si nécessaire -->
            </select>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Enregistrer</button>
    </form>
</div>

<!-- Affichage des membres existants -->
<div class="container mt-5">
    <h2>Liste des membres</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Tranche d'âge</th>
                <th>Sexe</th>
                <th>Situation matrimoniale</th>
                <th>Statut</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Récupération des membres depuis la base de données
$membres = $membre->readMember();

// Affichage des membres dans le tableau
foreach ($membres as $membre) {
    echo "<tr>";
    echo "<td>" . $membre['nom'] . "</td>";
    echo "<td>" . $membre['prenom'] . "</td>";
    echo "<td>" . $membre['tranche_age'] . "</td>";
    echo "<td>" . $membre['sexe'] . "</td>";
    echo "<td>" . $membre['situation_matrimoniale'] . "</td>";
    echo "<td>" . $membre['statut'] . "</td>";
    echo "<td>" . $membre['adresse'] . "</td>";
    echo "<td>";
    echo "<a href='update_membre.php?id=" . $membre['id'] . "' class='btn btn-primary btn-sm'>Modifier</a>";
    echo "<form action='delete_membre.php?id=" . $membre['id'] . "' method='POST' style='display: inline-block;'>";
    echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce membre ?\")'>Supprimer</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
?>

        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
