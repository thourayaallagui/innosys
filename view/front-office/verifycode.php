<?php
session_start();
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'karouistoufajunior@gmail.com');
define('SMTP_PASS', 'ceyb rukc gwdm uoqb'); // mot de passe d'application
define('SMTP_SECURE', PHPMailer::ENCRYPTION_STARTTLS);
define('SMTP_PORT', 587);

$pdo = new PDO('mysql:host=127.0.0.1;dbname=mabase;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$error = '';

if (isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['email'] = $email;

    // Vérifie que l'email existe dans la base
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() === 0) {
        die("❌ L'email n'existe pas dans notre base de données.");
    }

    // Générer et envoyer un nouveau code si demandé ou si session expirée
    if ((isset($_GET['send']) && $_GET['send'] == 1) || !isset($_SESSION['email_code']) || $_SESSION['email'] !== $email) {
        $code = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $_SESSION['email_code'] = [
            'code' => $code,
            'expire' => time() + 600
        ];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port = SMTP_PORT;

            $mail->setFrom(SMTP_USER, 'Support');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Votre code de vérification';
            $mail->Body = "Bonjour,<br><br>Votre code de vérification est : <b>$code</b><br>Ce code est valide pendant 10 minutes.<br><br>Merci.";

            $mail->send();

            // ✅ Rediriger pour éviter la régénération du code à chaque rechargement
            header("Location: verifycode.php?email=" . urlencode($email));
            exit;
        } catch (Exception $e) {
            die("Erreur d'envoi : " . $mail->ErrorInfo);
        }
    }
}

// Vérification du code soumis par l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_code = preg_replace('/\D/', '', $_POST['code'] ?? '');
    $real_code = $_SESSION['email_code']['code'] ?? '';
    $expire = $_SESSION['email_code']['expire'] ?? 0;

    if ($user_code === $real_code && time() <= $expire) {
        header('Location: resetpassword.php');
        exit;
    } elseif (time() > $expire) {
        $error = "Le code a expiré.";
    } else {
        $error = "Code invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification du code</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #cce5ff, #ffffff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            color: #333;
        }

        input[type="text"], button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            text-align: center;
            color: red;
            margin-top: 10px;
        }

        .resend {
            text-align: center;
            margin-top: 15px;
        }

        .resend a {
            color: #007bff;
            text-decoration: none;
        }

        .resend a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Vérification du code</h2>

    <?php if (isset($_SESSION['email'])): ?>
        <p>Un code a été envoyé à <strong><?= htmlspecialchars($_SESSION['email']) ?></strong></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Entrez le code :</label>
        <input type="text" name="code" required maxlength="5" placeholder="Ex: 12345">
        <button type="submit">Vérifier</button>
    </form>

    <?php if (isset($_SESSION['email'])): ?>
        <div class="resend">
            <a href="verifycode.php?email=<?= urlencode($_SESSION['email']) ?>&send=1">Renvoyer un nouveau code</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
