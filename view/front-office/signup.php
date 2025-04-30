<?php
require_once __DIR__ . '/../../config.php';
$db = config::getConnexion();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($nom && $prenom && $email && $password) {
        $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Cet email est déjà utilisé.';
        } else {
            $stmt = $db->prepare('INSERT INTO users (nom, prenom, email, password, type) VALUES (:nom, :prenom, :email, :password, "user")');
            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $password
            ]);
            $success = 'Compte créé avec succès. <a href="login.php">Connectez-vous ici</a>.';
        }
    } else {
        $error = 'Veuillez remplir tous les champs.';
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Inscription – Mon Site</title>
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
        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
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
        .login-box .success {
            color: green;
            margin-bottom: 15px;
        }
        .login-box .rules {
            text-align: left;
            font-size: 14px;
            margin: 10px 0;
        }
        .login-box .rules .valid {
            color: green;
        }
        .login-box .rules .invalid {
            color: red;
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
        <div class="icon">📝</div>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post" id="formr">
            <input type="text" name="nom" placeholder="Nom" required />
            <input type="text" name="prenom" placeholder="Prénom" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" id="password" name="password" placeholder="Mot de passe" required />

            <div class="rules">
                <div id="rule-length" class="invalid">🔴 8 caractères minimum</div>
                <div id="rule-uppercase" class="invalid">🔴 Une majuscule</div>
                <div id="rule-lowercase" class="invalid">🔴 Une minuscule</div>
                <div id="rule-number" class="invalid">🔴 Un chiffre</div>
            </div>

            <button type="submit">S'inscrire</button>
            <div style="margin-top:10px;">
                <a href="login.php">Déjà un compte ? Connexion</a>
            </div>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const ruleLength = document.getElementById('rule-length');
        const ruleUppercase = document.getElementById('rule-uppercase');
        const ruleLowercase = document.getElementById('rule-lowercase');
        const ruleNumber = document.getElementById('rule-number');

        function checkPasswordRules(value) {
            const rules = {
                length: value.length >= 8,
                uppercase: /[A-Z]/.test(value),
                lowercase: /[a-z]/.test(value),
                number: /\d/.test(value)
            };

            ruleLength.className = rules.length ? 'valid' : 'invalid';
            ruleLength.innerHTML = (rules.length ? '🟢' : '🔴') + ' 8 caractères minimum';

            ruleUppercase.className = rules.uppercase ? 'valid' : 'invalid';
            ruleUppercase.innerHTML = (rules.uppercase ? '🟢' : '🔴') + ' Une majuscule';

            ruleLowercase.className = rules.lowercase ? 'valid' : 'invalid';
            ruleLowercase.innerHTML = (rules.lowercase ? '🟢' : '🔴') + ' Une minuscule';

            ruleNumber.className = rules.number ? 'valid' : 'invalid';
            ruleNumber.innerHTML = (rules.number ? '🟢' : '🔴') + ' Un chiffre';

            return rules.length && rules.uppercase && rules.lowercase && rules.number;
        }

        passwordInput.addEventListener('input', function () {
            checkPasswordRules(passwordInput.value);
        });

        document.getElementById('formr').addEventListener('submit', function (e) {
            if (!checkPasswordRules(passwordInput.value)) {
                alert('Le mot de passe ne respecte pas les règles.');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
