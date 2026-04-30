<?php
// 3. Inclure la connexion à la base de données
include 'db.php';

// 4. Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Utilisation d'une requête préparée pour la sécurité
        $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        
        // 5. Redirection immédiate après succès
        header('Location: index.php?message=deleted');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur SQL, on l'affiche pour déboguer (à retirer en prod)
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    // Si pas d'ID, on retourne à l'index
    header('Location: index.php');
    exit();
}
?>