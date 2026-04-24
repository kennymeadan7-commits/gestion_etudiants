<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css"> </head>
<body>
    <div class="container">
        <h1>Inscription d'un Étudiant</h1>
        
        <form id="studentForm" action="traitement.php" method="POST">
            <input type="text" name="nom" id="nom" placeholder="Nom de l'étudiant">
            <input type="text" name="prenom" id="prenom" placeholder="Prénom de l'étudiant">
            
            <select name="filiere_id">
                <?php
                [cite_start]// Récupération des filières [cite: 75]
                $query = $pdo->query("SELECT * FROM filieres");
                while($filiere = $query->fetch()) {
                    echo "<option value='".$filiere['id']."'>".$filiere['nom']."</option>";
                }
                ?>
            </select>
            
            <button type="submit">Enregistrer</button>
        </form>
        
        <div id="error-message" style="color: red;"></div>
    </div>

    <script src="assets/js/script.js"></script> </body>
</html>