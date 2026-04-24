<?php 
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Étudiants</h1>
        
        <section>
            <form id="studentForm" action="traitement.php" method="POST">
                <input type="text" name="nom" id="nom" placeholder="Nom" required>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
                
                <select name="filiere_id" required>
                    <option value="">Sélectionner une filière</option>
                    <?php
                    // LIGNE 19 : Cette ligne ne posera plus d'erreur
                    $query = $pdo->query("SELECT * FROM filieres");
                    while($filiere = $query->fetch()) {
                        echo "<option value='".$filiere['id']."'>".htmlspecialchars($filiere['nom'])."</option>";
                    }
                    ?>
                </select>
                
                <button type="submit">Ajouter l'étudiant</button>
            </form>
            <div id="error-message" style="color: red; margin-top: 10px;"></div>
        </section>

        <hr>

        <section>
            <table class="student-table">
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
                    // Jointure pour afficher le nom de la filière [cite: 120]
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
                                <a href='update.php?id=" . $row['id'] . "'>Modifier</a> | 
                                <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Confirmer ?\")'>Supprimer</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    echo "<td>
        <a href='update.php?id=" . $row['id'] . "' class='btn-edit'>Modifier</a>
        <a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Supprimer cet étudiant ?\")'>Supprimer</a>
      </td>";
    <script src="assets/js/script.js"></script>
</body>
</html>