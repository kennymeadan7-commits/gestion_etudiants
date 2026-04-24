<?php
// Inclusion de la connexion
include 'db.php';

// Vérification de la présence de l'ID dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparation de la requête de suppression (sécurisée)
    $sql = "DELETE FROM etudiants WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Exécution de la suppression
    $stmt->execute(['id' => $id]);
}

// Redirection immédiate vers la page principale [cite: 140]
header('Location: index.php');
exit();
?>