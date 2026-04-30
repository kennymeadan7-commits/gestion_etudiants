<?php
include 'db.php';

// Récupération de l'étudiant
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
    $etudiant = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Étudiant - EduManager</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Centrage spécifique pour la page de modification */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f4f8;
            margin: 0;
        }
        .edit-card {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
        }
        .form-update {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--secondary);
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .btn-cancel {
            flex: 1;
            text-align: center;
            padding: 12px;
            background: #eee;
            color: var(--dark);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-cancel:hover { background: #e0e0e0; }
    </style>
</head>
<body>

    <div class="edit-card">
        <h1 style="text-align: center; margin-bottom: 10px;">Modifier l'Étudiant</h1>
        <p style="text-align: center; color: var(--secondary); font-size: 0.9rem;">Mettez à jour les informations de l'élève ci-dessous.</p>

        <form action="traitement_update.php" method="POST" class="form-update">
            <!-- Champ caché pour l'ID -->
            <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
            </div>

            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
            </div>

            <div class="form-group">
                <label>Filière</label>
                <select name="filiere_id" required>
                    <?php
                    $filieres = $pdo->query("SELECT * FROM filieres")->fetchAll();
                    foreach ($filieres as $f) {
                        $selected = ($f['id'] == $etudiant['filiere_id']) ? 'selected' : '';
                        echo "<option value='{$f['id']}' $selected>{$f['nom']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="btn-group">
                <a href="index.php" class="btn-cancel">Annuler</a>
                <button type="submit" class="btn-add" style="flex: 2; margin: 0;">Mettre à jour</button>
            </div>
        </form>
    </div>

</body>
</html>