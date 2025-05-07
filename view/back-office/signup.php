<?php
session_start();
include('../../config.php');
include('../../controller/userC.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = 'client';

    if (!empty($nom) && !empty($prenom) && !empty($age) && !empty($email) && !empty($password) && !empty($type)) {
        $user = new User($nom, $prenom, $email, $password, $age, $type);
        $userC = new userC();
        $userC->create($user);
        header("Location: login.php");
        die;
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #a1c4fd, #c2e9fb); /* Dégradé bleu ciel */
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

        .login-box input {
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

        .error {
            color: red;
            margin-bottom: 15px;
        }

        #password-rules p {
            margin: 2px 0;
            font-size: 12px;
            text-align: left;
        }

        .invalid {
            color: red;
        }

        .valid {
            color: green;
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
    </style>
</head>

<body>
    <div class="login-box">
        <div class="icon">👤</div>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" id="formr">
            <input type="text" name="nom" placeholder="Nom" required />
            <input type="text" name="prenom" placeholder="Prenom" required />
            <input type="number" name="age" placeholder="Âge" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" id="password" placeholder="Mot de passe" required />

            <div id="password-rules">
                <p id="rule-length" class="invalid">🔴 8 caractères minimum</p>
                <p id="rule-uppercase" class="invalid">🔴 Une majuscule</p>
                <p id="rule-lowercase" class="invalid">🔴 Une minuscule</p>
                <p id="rule-number" class="invalid">🔴 Un chiffre</p>
            </div>

            <button type="submit">S'inscrire</button>
            <a href="login.php">Déjà un compte ? Connexion</a>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const ruleLength = document.getElementById('rule-length');
        const ruleUppercase = document.getElementById('rule-uppercase');
        const ruleLowercase = document.getElementById('rule-lowercase');
        const ruleNumber = document.getElementById('rule-number');

        passwordInput.addEventListener('input', function () {
            const value = passwordInput.value;

            // Longueur
            if (value.length >= 8) {
                ruleLength.classList.remove('invalid');
                ruleLength.classList.add('valid');
                ruleLength.innerHTML = '🟢 8 caractères minimum';
            } else {
                ruleLength.classList.remove('valid');
                ruleLength.classList.add('invalid');
                ruleLength.innerHTML = '🔴 8 caractères minimum';
            }

            // Majuscule
            if (/[A-Z]/.test(value)) {
                ruleUppercase.classList.remove('invalid');
                ruleUppercase.classList.add('valid');
                ruleUppercase.innerHTML = '🟢 Une majuscule';
            } else {
                ruleUppercase.classList.remove('valid');
                ruleUppercase.classList.add('invalid');
                ruleUppercase.innerHTML = '🔴 Une majuscule';
            }

            // Minuscule
            if (/[a-z]/.test(value)) {
                ruleLowercase.classList.remove('invalid');
                ruleLowercase.classList.add('valid');
                ruleLowercase.innerHTML = '🟢 Une minuscule';
            } else {
                ruleLowercase.classList.remove('valid');
                ruleLowercase.classList.add('invalid');
                ruleLowercase.innerHTML = '🔴 Une minuscule';
            }

            // Chiffre
            if (/\d/.test(value)) {
                ruleNumber.classList.remove('invalid');
                ruleNumber.classList.add('valid');
                ruleNumber.innerHTML = '🟢 Un chiffre';
            } else {
                ruleNumber.classList.remove('valid');
                ruleNumber.classList.add('invalid');
                ruleNumber.innerHTML = '🔴 Un chiffre';
            }
        });

        let myform = document.getElementById('formr');
        myform.addEventListener('submit', function(e) {
            const rules = document.querySelectorAll('#password-rules p');
            let valid = true;

            // Vérification si toutes les règles sont respectées
            rules.forEach(rule => {
                if (rule.classList.contains('invalid')) {
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault(); // Empêcher la soumission si les règles ne sont pas respectées
            }
        });
    </script>
</body>
</html>