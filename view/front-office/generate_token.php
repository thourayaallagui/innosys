<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "mabase");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Email d'un utilisateur existant (à modifier si besoin)
$email = "test@example.com"; // Remplace par un vrai email de ta table users

// Génération d'un token sécurisé
$token = bin2hex(random_bytes(32));
$expire = date('Y-m-d H:i:s', strtotime('+30 minutes'));

// Mise à jour de la base avec le token
$sql = "UPDATE users SET reset_token = '$token', token_expire = '$expire' WHERE email = '$email'";
if ($conn->query($sql) === TRUE) {
    echo "✅ Lien de réinitialisation généré avec succès :<br><br>";
    echo "<a href='http://localhost/guser/view/front-office/resetpassword.php?token=$token'>http://localhost/guser/view/front-office/resetpassword.php?token=$token</a>";
} else {
    echo "❌ Erreur : " . $conn->error;
}

$conn->close();
?>
