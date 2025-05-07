<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../model/SmsService.php';

$db = config::getConnexion();
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $recaptcha = $_POST['g-recaptcha-response'] ?? '';

    if (!$recaptcha) {
        $errorMsg = 'Veuillez valider le reCAPTCHA.';
    } else {
        $secretKey = '6Lec_SorAAAAACCY-MTVhydHuEI8wmmURYg6FpY3';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}");
        $responseKeys = json_decode($response, true);

        if ($responseKeys['success']) {
            if ($email !== '' && $password !== '' && !is_numeric($email)) {
                try {
                    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
                    $stmt->execute(['email' => $email]);
                    $u = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($u && $u['password'] === $password) {
                        $_SESSION['type'] = $u['type'];
                        $_SESSION['nom'] = $u['nom'];
                        $_SESSION['prenom'] = $u['prenom'];
                        $_SESSION['email'] = $u['email'];
                        $_SESSION['id'] = $u['id'];

                        $sms = new SmsService();
                        $userPhone = !empty($u['telephone']) ? $u['telephone'] : '+18453902257';
                        $sms->send($userPhone, 'Bonjour ' . $u['prenom'] . ', connexion réussie');

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
        } else {
            $errorMsg = 'Échec de la vérification reCAPTCHA.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #007BFF, #ffffff);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .login-container {
      background: #fff;
      border-radius: 20px;
      padding: 50px 40px;
      box-shadow: 0 10px 30px rgba(0, 123, 255, 0.3);
      width: 100%;
      max-width: 400px;
      position: relative;
      z-index: 2;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      color: #007BFF;
      font-weight: 600;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #007BFF;
      border-radius: 10px;
      font-size: 16px;
      transition: border-color 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #0056b3;
      outline: none;
    }

    .btn-login {
      background-color: #007BFF;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #0056b3;
    }

    .forgot {
      text-align: right;
      font-size: 14px;
      margin-top: 10px;
    }

    .forgot a {
      color: #0056b3;
      text-decoration: none;
    }

    .forgot a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 14px;
      text-align: center;
      margin-bottom: 15px;
    }

    .signup-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .signup-link a {
      color: #0056b3;
      text-decoration: none;
    }

    .g-recaptcha {
      margin: 15px 0;
    }

    .wave-bg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 0;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Connexion</h2>
    <?php if ($errorMsg): ?>
      <div class="error"><?= htmlspecialchars($errorMsg) ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="form-group">
        <input type="email" name="email" placeholder="Adresse email" required>
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Mot de passe" required>
      </div>
      <div class="g-recaptcha" data-sitekey="6Lec_SorAAAAAB8C_m0-s-5Tv3PcP_AStautW9hf"></div>
      <button type="submit" class="btn-login">Se connecter</button>
      <div class="forgot">
        <a href="forgotpassword.php">Mot de passe oublié ?</a>
      </div>
      <div class="signup-link">
        Pas encore de compte ? <a href="signup.php">Inscription</a>
      </div>
    </form>
  </div>

  <img src="https://www.svgrepo.com/show/13651/wave.svg" alt="wave" class="wave-bg">
</body>
</html>
