<?php
session_start();
include('../../config.php');

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $recaptcha = $_POST['g-recaptcha-response'] ?? '';

    if (!$recaptcha) {
        $errorMsg = 'Veuillez valider le reCAPTCHA.';
    } else {
        $secretKey = '6Lec_SorAAAAACCY-MTVhydHuEI8wmmURYg6FpY3';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}");
        $responseKeys = json_decode($response, true);

        if ($responseKeys['success']) {
            if (!empty($email) && !empty($password) && !is_numeric($email)) {
                $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
                $db = config::getConnexion();
                try {
                    $stmt = $db->prepare($query);
                    $stmt->execute(['email' => $email]);
                    $u = $stmt->fetch();

                    if ($u && $u['password'] === $password) {
                        $_SESSION['type'] = $u['type'];
                        $_SESSION['nom'] = $u['nom'];
                        $_SESSION['email'] = $u['email'];
                        $_SESSION['prenom'] = $u['prenom'];
                        $_SESSION['id'] = $u['id'];
                        header("Location: users.php");
                        exit;
                    } else {
                        $errorMsg = "Nom d'utilisateur ou mot de passe incorrect !";
                    }
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            } else {
                $errorMsg = "Nom d'utilisateur ou mot de passe incorrect !";
            }
        } else {
            $errorMsg = "Échec de la vérification reCAPTCHA.";
        }
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Admin</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #a1c4fd, #c2e9fb);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 8px;
            width: 320px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-box .icon {
            font-size: 40px;
            color: #6a1b9a;
            margin-bottom: 20px;
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 2px solid black;
            outline: none;
            font-size: 16px;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: black;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-box button:hover {
            background: #333;
        }

        .login-box a {
            display: block;
            margin-top: 10px;
            color: #6a1b9a;
            text-decoration: none;
            font-size: 14px;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="icon">👤</div>

        <?php if (!empty($errorMsg)): ?>
            <div class="error"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Mot de passe" required />
            <div class="g-recaptcha" data-sitekey="6Lec_SorAAAAAB8C_m0-s-5Tv3PcP_AStautW9hf" style="margin: 15px 0;"></div>
            <button type="submit">Se connecter</button>
            <a href="signup.php">Créer un nouveau compte</a>
        </form>
    </div>
</body>
</html>
