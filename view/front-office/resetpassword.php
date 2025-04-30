<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "mabase");

if (isset($_GET['email']) && isset($_GET['code'])) {
    $email = $_GET['email'];
    $code = $_GET['code'];
} else {
    die("Lien invalide.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $code_input = $_POST["code"];
    $email = $_GET['email']; // Récupération depuis l'URL

    if ($new_password !== $confirm_password) {
        $message = "Les mots de passe ne correspondent pas.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $new_password)) {
        $message = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
    } else {
        // Vérification du code
        $stmt = $conn->prepare("SELECT reset_token, token_expire FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $user["reset_token"] === $code_input && strtotime($user["token_expire"]) > time()) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expire = NULL, reset_at = NOW() WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);
            $stmt->execute();

            header("Location: login.php?reset=success");
            exit;
        } else {
            $message = "Code invalide ou expiré.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <style>
        body {
            background-color: #f6f6f6;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .reset-box {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="reset-box">
        <h2>Réinitialiser le mot de passe</h2>

        <?php if ($message): ?>
            <div class="error"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST">
            <!-- Champ caché du code -->
            <input type="hidden" name="code" value="<?= htmlspecialchars($code) ?>">

            <label>Nouveau mot de passe :</label>
            <input type="password" name="new_password" required>

            <label>Confirmer le mot de passe :</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Réinitialiser</button>
        </form>
    </div>
</body>
</html>
