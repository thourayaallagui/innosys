<?php
session_start();
include('../../config.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {

        //read from database
        $query = "select * from users where email = '$email' limit 1";
        $db = config::getConnexion();
        try {
            $liste = $db->query($query);
            $u = $liste->fetch();
            if ($u) {
                if ($u['password'] === $password) {
                    $_SESSION['type'] = $u['type'];
                    $_SESSION['nom'] = $u['nom'];
                    $_SESSION['email'] = $u['email'];
                    $_SESSION['prenom'] = $u['prenom'];
                    $_SESSION['id'] = $u['id'];
                    header("Location: users.php");
                    die;
                }
            }
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
    </style>
</head>

<body>
    <div class="login-box">
        <div class="icon">👤</div>
        <form method="post">
            <input type="email" name="email" placeholder="mail@" required />
            <input type="password" name="password" placeholder="password" required />
            <button type="submit">Log in</button>
        </form>
    </div>
</body>

</html>