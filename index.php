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
    <hr>
<h2>Liste des Étudiants</h2>
<table border="1" class="student-table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Filière</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Requête avec jointure pour récupérer le nom de la filière
        $sql = "SELECT etudiants.id, etudiants.nom, etudiants.prenom, filieres.nom AS filiere_nom 
                FROM etudiants 
                JOIN filieres ON etudiants.filiere_id = filieres.id";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['filiere_nom']) . "</td>";
            echo "<td>
                    <a href='update.php?id=" . $row['id'] . "' class='btn-edit'>Modifier</a>
                    <a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Voulez-vous vraiment supprimer cet étudiant ?\")'>Supprimer</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

    <script src="assets/js/script.js"></script> </body>
</html>