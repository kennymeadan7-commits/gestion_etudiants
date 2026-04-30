<?php
include 'db.php';

// 2. COMPTEUR : On récupère le nombre total d'étudiants
$countStmt = $pdo->query("SELECT COUNT(*) FROM etudiants");
$total = $countStmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManager - Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    
    <div class="container">
        <h1>Tableau de Bord</h1>

        <section>
            <form id="studentForm" action="traitement.php" method="POST" class="form-grid">
                <input type="text" name="nom" id="nom" placeholder="Nom de l'étudiant" required>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom de l'étudiant" required>
                
                <select name="filiere_id" id="filiere" required>
                    <option value="">-- Choisir une filière --</option>
                    <?php
                    $query = $pdo->query("SELECT * FROM filieres ORDER BY nom ASC");
                    while($filiere = $query->fetch()) {
                        echo "<option value='".$filiere['id']."'>".htmlspecialchars($filiere['nom'])."</option>";
                    }
                    ?>
                </select>
                
                <button type="submit" class="btn-add">Ajouter l'étudiant</button>
            </form>
            <div id="error-message" style="color: var(--danger); text-align: center; margin-top: -20px; margin-bottom: 20px;"></div>
        </section>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 40px 0;">

        <section>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="font-size: 1.2rem; margin: 0; color: var(--dark);">Liste des inscrits</h2>
                <span style="background: var(--primary); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                    <?= $total ?> Étudiants au total
                </span>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Filière</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Requête avec jointure ET tri par nom
                    $sql = "SELECT etudiants.id, etudiants.nom, etudiants.prenom, filieres.nom AS filiere_nom 
                            FROM etudiants 
                            JOIN filieres ON etudiants.filiere_id = filieres.id 
                            ORDER BY etudiants.nom ASC";
                    $stmt = $pdo->query($sql);

                    if ($total > 0) {
                        while ($row = $stmt->fetch()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['filiere_nom']) . "</td>";
                            echo "<td style='text-align: right;'>
                                    <a href='update.php?id=" . $row['id'] . "' class='btn-edit'>Modifier</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Voulez-vous vraiment supprimer cet étudiant ?\")'>Supprimer</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align:center; color:var(--secondary);'>Aucun étudiant enregistré pour le moment.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>