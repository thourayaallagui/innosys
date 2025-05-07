<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        require_once __DIR__ . '/../../config.php';
        $pdo = Config::getConnexion();

        // Vérifie si l'e-mail existe dans la base
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 0) {
            $_SESSION['message'] = "❌ Cette adresse e-mail n'existe pas.";
        } else {
            // Génère un code de vérification
            $code = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

            // Envoie de l'e-mail avec le code
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'karouistoufajunior@gmail.com';
                $mail->Password = 'axam aian qkvf mqsq'; // mot de passe d'application
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('karouistoufajunior@gmail.com', 'Vérification de compte');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Votre code de vérification';
                $mail->Body = "Bonjour,<br><br>Voici votre code de vérification : <b>$code</b><br>Il est valable pendant 10 minutes.<br><br>Merci.";

                $mail->send();

                // Enregistre le code en base de données
                $updateStmt = $pdo->prepare("UPDATE users SET reset_code = ?, reset_at = NOW() WHERE email = ?");
                $updateStmt->execute([$code, $email]);

                // Sauvegarde dans la session pour l'étape suivante
                $_SESSION['reset_email'] = $email;

                // Redirige vers la page de vérification
                header("Location: verifycode.php?email=" . urlencode($email));
                exit();
            } catch (Exception $e) {
                $_SESSION['message'] = "Erreur lors de l'envoi du mail : {$mail->ErrorInfo}";
            }
        }
    } else {
        $_SESSION['message'] = "Adresse e-mail invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
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

        input[type="email"], button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mot de passe oublié</h2>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        ?>

        <form method="POST">
            <label for="email">Entrez votre adresse e-mail :</label>
            <input type="email" name="email" required placeholder="exemple@domaine.com">
            <button type="submit">Envoyer le code</button>
        </form>
    </div>
</body>
</html>
