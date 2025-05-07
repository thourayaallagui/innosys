<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: verifycode.php');
    exit;
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=127.0.0.1;dbname=mabase;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les données du formulaire
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($new_password) || empty($confirm_password)) {
    die("Veuillez remplir les deux champs.");
}

if ($new_password !== $confirm_password) {
    die("❌ Les mots de passe ne correspondent pas.");
}

// ⚠️ Stockage en clair (non recommandé en production)
$email = $_SESSION['email'];
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->execute([$new_password, $email]);

// Nettoyage de session
unset($_SESSION['email']);
unset($_SESSION['email_code']);

// Message + lien vers compte
echo "✅ Mot de passe mis à jour avec succès.<br><br>";
echo '<a href="myaccount.php">👉 Se connecter à mon compte</a>';
?>
