<?php
include __DIR__.'/../../Controller/ReclamController.php';
$error = '';
$reclamation = null;
$reclamationC = new ReclamController();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $reclamation = $reclamationC->getReclamationById($id);

    if (!$reclamation) {
        die("Erreur : La réclamation n'existe pas.");
    }
} else {
    die("Erreur : ID de la réclamation non fourni.");
}

if (isset($_POST['date_creation'], $_POST['objet'], $_POST['statut'], $_POST['nom_utilisateur'])) {
    $reclamation = new Reclamation(
        $_POST['date_creation'],
        $_POST['objet'],
        $_POST['statut'],
        $_POST['nom_utilisateur']
    );

    $reclamationC->updateReclamation($id, $reclamation);

    header("Location: reclamationview.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier Réclamation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="forum-card form-card">
    <h3 class="form-heading">Modifier une Réclamation</h3>
    <form method="POST" class="formulaire" action="modifier.php?id=<?php echo $id; ?>">
        <div class="form-group">
            <label>Date :</label>
            <input type="date" name="date_creation" value="<?php echo htmlspecialchars($reclamation['date_creation']); ?>" required>
        </div>
        <br>
        <label>Objet :</label>
        <input type="text" name="objet" value="<?php echo htmlspecialchars($reclamation['objet']); ?>" required>
        <br>
        <label>Statut :</label>
        <select name="statut" required>
            <option value="En attente" <?php if ($reclamation['statut'] == "En attente") echo 'selected'; ?>>En attente</option>
            <option value="En cours" <?php if ($reclamation['statut'] == "En cours") echo 'selected'; ?>>En cours</option>
            <option value="Résolue" <?php if ($reclamation['statut'] == "Résolue") echo 'selected'; ?>>Résolue</option>
        </select>
        <br>
        <br>
        <label>Nom utilisateur :</label>
        <input type="text" name="nom_utilisateur" value="<?php echo htmlspecialchars($reclamation['nom_utilisateur']); ?>" required>
        <br><br>
        <input type="submit" value="Mettre à jour" class="btn-primary">
        <a href="reclamationview.php" class="btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
