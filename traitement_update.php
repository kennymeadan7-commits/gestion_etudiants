<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On récupère les données envoyées par le formulaire de update.php
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    if (!empty($id) && !empty($nom) && !empty($prenom) && !empty($filiere_id)) {
        // Requête de mise à jour sécurisée avec PDO
        $sql = "UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nom, $prenom, $filiere_id, $id])) {
            // Succès : retour à l'accueil
            header('Location: index.php?msg=success_update');
            exit();
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>