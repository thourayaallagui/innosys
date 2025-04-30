<?php
session_start();
require_once __DIR__ . '/../../config.php';

$db = config::getConnexion();
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email !== '' && $password !== '' && !is_numeric($email)) {
        try {
            $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $email]);
            $u = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($u && $u['password'] === $password) {
                $_SESSION['type']   = $u['type'];
                $_SESSION['nom']    = $u['nom'];
                $_SESSION['prenom'] = $u['prenom'];
                $_SESSION['email']  = $u['email'];
                $_SESSION['id']     = $u['id'];
                header('Location: myaccount.php');
                exit();
            } else {
                $errorMsg = 'Email ou mot de passe incorrect.';
            }
        } catch (PDOException $e) {
            die('Erreur base de données : ' . $e->getMessage());
        }
    } else {
        $errorMsg = 'Email ou mot de passe incorrect.';
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion – Mon Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(71, 90, 228);
            background-image: 
                linear-gradient(0deg, transparent 24%, #000 25%, #000 26%, transparent 27%, transparent 74%, #000 75%, #000 76%, transparent 77%, transparent),
                linear-gradient(90deg, transparent 24%, #000 25%, #000 26%, transparent 27%, transparent 74%, #000 75%, #000 76%, transparent 77%, transparent);
            background-size: 50px 50px;
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
            width: 300px;
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
        .login-box .error {
            color: red;
            margin-bottom: 15px;
        }
        .login-box .forgot {
            margin-top: 8px;
            font-size: 14px;
        }
        .login-box .forgot a {
            color: #6a1b9a;
            text-decoration: none;
        }
        .login-box .forgot a:hover {
            text-decoration: underline;
        }
        a {
            color: #6a1b9a;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="icon">👤</div>

        <?php if ($errorMsg): ?>
            <div class="error"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Mot de passe" required />
            <div class="forgot">
                <a href="forgotpassword.php">Mot de passe oublié ?</a>
            </div>
            <button type="submit">Se connecter</button>
            <br><br>
            <a href="signup.php">Pas encore de compte ? Inscription</a>
        </form>
    </div>
</body>
</html>
