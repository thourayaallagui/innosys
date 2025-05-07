<?php 
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:login.php");
  exit;
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

include('../../controller/userC.php');

$error = "";
$userC = new userC();
$user = $userC->findone($_SESSION['id']);

if (
  isset($_POST["nom"]) &&
  isset($_POST["prenom"]) &&
  isset($_POST["email"]) &&
  isset($_POST["password"]) &&
  isset($_POST["age"]) &&
  isset($_POST["type"])
) {
  if (
    !empty($_POST["nom"]) &&
    !empty($_POST['prenom']) &&
    !empty($_POST["email"]) &&
    !empty($_POST["password"]) &&
    !empty($_POST["age"]) &&
    !empty($_POST["type"])
  ) {
    $user = new user(
      $_POST['nom'],
      $_POST['prenom'],
      $_POST['email'],
      $_POST['password'],
      $_POST['age'],
      $_POST['type']
    );
    $userC->update($user, $_SESSION['id']);
    header('Location:index.php');
  } else
    $error = "Informations manquantes";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Mon Compte</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #e0f7fa;
      color: #333;
    }
    .card {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .form-control:focus {
      border-color: #00bcd4;
      box-shadow: 0 0 0 0.2rem rgba(0,188,212,.25);
    }
    .btn-primary {
      background-color: #00bcd4;
      border-color: #00bcd4;
    }
    .btn-primary:hover {
      background-color: #0097a7;
      border-color: #0097a7;
    }
    .form-label {
      font-weight: 500;
    }
    .form-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #00bcd4;
    }
    .form-group {
      position: relative;
    }
    .form-control {
      padding-left: 40px;
    }
  </style>
</head>

<body>

  <header class="bg-white shadow-sm py-3 mb-4">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="h4 mb-0">Mon Compte</h1>
      <a href="?logout=true" class="btn btn-outline-danger">Déconnexion</a>
    </div>
  </header>

  <main class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card p-4">
          <h5 class="card-title mb-4 text-center">Modifier mes informations</h5>
          <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>
          <form method="post">
            <div class="mb-3 form-group">
              <label for="nom" class="form-label">Nom</label>
              <i class="bi bi-person form-icon"></i>
              <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
            </div>
            <div class="mb-3 form-group">
              <label for="prenom" class="form-label">Prénom</label>
              <i class="bi bi-person form-icon"></i>
              <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
            </div>
            <div class="mb-3 form-group">
              <label for="age" class="form-label">Âge</label>
              <i class="bi bi-calendar form-icon"></i>
              <input type="number" class="form-control" id="age" name="age" min="8" max="90" value="<?= htmlspecialchars($user['age']) ?>" required>
            </div>
            <div class="mb-3 form-group">
              <label for="email" class="form-label">Adresse e-mail</label>
              <i class="bi bi-envelope form-icon"></i>
              <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3 form-group">
              <label for="password" class="form-label">Mot de passe</label>
              <i class="bi bi-lock form-icon"></i>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-4 form-group">
              <label for="typeinput" class="form-label">Type</label>
              <i class="bi bi-person-badge form-icon"></i>
              <select name="type" class="form-control" id="typeinput" required>
                <option value="admin" <?= $user['type'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="client" <?= $user['type'] === 'client' ? 'selected' : '' ?>>Client</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <footer class="text-center py-4 mt-5">
    <p class="mb-0">&copy; 2025 MyApp. Tous droits réservés.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
