<?php
// Activer les erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'mabase'; // à adapter
$user = 'root';
$pass = ''; // à adapter

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie que l'e-mail est passé dans l'URL
$email = $_GET['email'] ?? '';
if (!$email) {
    die("Aucune adresse e-mail fournie.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification du code</title>
</head>
<body>
    <h2>Entrez le code de vérification</h2>
    <form method="post">
        <label for="code">Code (5 chiffres) :</label><br>
        <input type="text" id="code" name="code" pattern="\d{5}" required><br><br>
        <button type="submit">Vérifier</button>
    </form>

<?php
// Si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['code'])) {
    $code = $_POST['code'];

    // Vérifie le code dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND reset_code = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)");
    $stmt->execute([$email, $code]);
    $user = $stmt->fetch();

    if ($user) {
        // Le code est correct : rediriger vers resetpassword.php avec un identifiant sécurisé
        header("Location: resetpassword.php?email=" . urlencode($email) . "&code=" . urlencode($code));
        exit;
    } else {
        echo "<p style='color:red;'>Code incorrect ou expiré.</p>";
    }
}
?>
</body>
</html>
