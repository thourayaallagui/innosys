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
        $error = "Please fill in all fields";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(71, 90, 228);
            background-image: linear-gradient(0deg, transparent 24%, #000 25%, #000 26%, transparent 27%, transparent 74%, #000 75%, #000 76%, transparent 77%, transparent),
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

        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 0 0;
            border-radius: 8px;
            border: 2px solid black;
            outline: none;
            font-size: 16px;
        }

        .login-box p {
            margin: 0;
            font-size: 13px;
            height: 16px;
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
            display: inline-block;
            margin-top: 10px;
            color: #6a1b9a;
            font-size: 14px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="icon">👤</div>
        <form method="post" id="formr">
            <input type="text" name="nom" id="nom" placeholder="Nom" />
            <p id="nomr"></p>

            <input type="text" name="prenom" id="prenom" placeholder="Prenom" />
            <p id="prenomr"></p>

            <input type="text" name="age" id="age" placeholder="Âge" />
            <p id="ager"></p>

            <input type="text" name="email" id="email" placeholder="Email" />
            <p id="emailr"></p>

            <input type="password" name="password" id="password" placeholder="Mot de passe" />
            <p id="passwordr"></p>

            <button type="submit">Sign up</button>
            <a href="login.php">Already have an account?</a>
        </form>
    </div>

    <script>
        let myform = document.getElementById('formr');
        myform.addEventListener('submit', function(e) {
            let nameinput = document.getElementById('nom');
            let lnameinput = document.getElementById('prenom');
            let age = document.getElementById('age');
            let pw = document.getElementById('password');
            let email = document.getElementById('email');

            const regex = /^[a-zA-Z-\s]+$/;

            // Reset previous errors
            ['nomr', 'prenomr', 'ager', 'passwordr', 'emailr'].forEach(id => {
                document.getElementById(id).innerHTML = '';
            });

            if (lnameinput.value === '') {
                document.getElementById('prenomr').innerHTML = "Le champ prénom est vide.";
                document.getElementById('prenomr').style.color = 'red';
                e.preventDefault();
            } else if (!regex.test(lnameinput.value)) {
                document.getElementById('prenomr').innerHTML = "Le prénom doit contenir uniquement des lettres et tirets.";
                document.getElementById('prenomr').style.color = 'red';
                e.preventDefault();
            }

            if (nameinput.value === '') {
                document.getElementById('nomr').innerHTML = "Le champ nom est vide.";
                document.getElementById('nomr').style.color = 'red';
                e.preventDefault();
            } else if (!regex.test(nameinput.value)) {
                document.getElementById('nomr').innerHTML = "Le nom doit contenir uniquement des lettres et tirets.";
                document.getElementById('nomr').style.color = 'red';
                e.preventDefault();
            }

            if (pw.value === '') {
                document.getElementById('passwordr').innerHTML = "Le champ mot de passe est vide.";
                document.getElementById('passwordr').style.color = 'red';
                e.preventDefault();
            }

            if (email.value === '') {
                document.getElementById('emailr').innerHTML = "Le champ email est vide.";
                document.getElementById('emailr').style.color = 'red';
                e.preventDefault();
            }

            if (age.value === '') {
                document.getElementById('ager').innerHTML = "Le champ âge est vide.";
                document.getElementById('ager').style.color = 'red';
                e.preventDefault();
            } else if (!(/^[0-9]+$/.test(age.value))) {
                document.getElementById('ager').innerHTML = "L'âge doit contenir uniquement des chiffres.";
                document.getElementById('ager').style.color = 'red';
                e.preventDefault();
            }
        });
    </script>
</body>

</html>