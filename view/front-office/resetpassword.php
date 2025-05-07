<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: verifycode.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
    <h2>Réinitialiser le mot de passe pour <?= htmlspecialchars($_SESSION['email']) ?></h2>
    <form method="post" action="reset_handler.php">
    <label>Nouveau mot de passe :</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirmer le mot de passe :</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Valider</button>
</form>

</body>
</html>
