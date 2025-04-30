<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background-color: #f0f2f5;
        }
        form {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- fichier : forgotpassword.php -->
    <form action="sendreset.php" method="POST">
       <label for="email">Entrez votre adresse e-mail :</label><br>
       <input type="email" name="email" required>
       <br><br>
       <button type="submit">Envoyer le code</button>
    </form>


</body>
</html>
