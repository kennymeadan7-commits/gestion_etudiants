<?php
// Inclusion de la connexion à la base de données [cite: 67]
include 'db.php';

// Vérification que les données ont bien été envoyées via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire [cite: 109]
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    // Préparation de la requête sécurisée [cite: 111]
    $sql = "INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (:nom, :prenom, :filiere_id)";
    $stmt = $pdo->prepare($sql);

    // Exécution de l'insertion [cite: 110]
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'filiere_id' => $filiere_id
    ]);

    // Redirection vers la page principale après insertion [cite: 112]
    header('Location: index.php');
    exit();
}
?>