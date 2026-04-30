<?php 
include 'db.php'; 

// 1. Récupérer l'étudiant à modifier
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
    $etudiant = $stmt->fetch();

    if (!$etudiant) {
        die("Étudiant non trouvé.");
    }
}

// 2. Traitement de la mise à jour (si le formulaire est soumis)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    $sql = "UPDATE etudiants SET nom = :nom, prenom = :prenom, filiere_id = :filiere_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'filiere_id' => $filiere_id,
        'id' => $id
    ]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
 </head>
<body>
    <div class="container"> <h1>Modifier l'Étudiant</h1>
        
        <form id="updateForm" action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
            
            <div class="input-group">
                <label>Nom</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>">
            </div>
            
            <div class="input-group">
                <label>Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>">
            </div>
            
            <div class="input-group">
                <label>Filière</label>
                <select name="filiere_id">
                    <?php
                    $query = $pdo->query("SELECT * FROM filieres");
                    while($filiere = $query->fetch()) {
                        $selected = ($filiere['id'] == $etudiant['filiere_id']) ? 'selected' : '';
                        echo "<option value='".$filiere['id']."' $selected>".$filiere['nom']."</option>";
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit">Mettre à jour</button>
            <a href="index.php" class="btn-delete" style="text-align:center; margin-top:10px; display:block;">Annuler</a>
        </form>
        <div id="error-message" style="color: red;"></div>
    </div>
    <script src="assets/js/script.js"></script> </body>
</html>