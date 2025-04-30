<?php
// Activer les erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'mabase'; // Remplace par le nom réel de ta base de données
$user = 'root';
$pass = ''; // Mets ton mot de passe s’il y en a un

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = $_POST['email'];

    // Vérifie si l'e-mail existe dans la base
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Génère un code à 5 chiffres
        $code = random_int(10000, 99999);

        // Enregistre le code dans la base de données
        $stmt = $pdo->prepare("UPDATE users SET reset_code = ?, reset_at = NOW() WHERE email = ?");
        $stmt->execute([$code, $email]);

        // Simule l'envoi par e-mail (affiche le code)
        echo "<h3>Un code de réinitialisation a été généré (simulation) :</h3>";
        echo "<p style='font-size: 24px; color: green;'><strong>Code : $code</strong></p>";
        echo "<p><a href='verifycode.php?email=" . urlencode($email) . "'>Cliquez ici pour entrer le code</a></p>";
    } else {
        echo "<p style='color:red;'>Aucun utilisateur trouvé avec cet e-mail.</p>";
    }
} else {
    echo "<p style='color:red;'>Veuillez entrer une adresse e-mail.</p>";
}
?>
