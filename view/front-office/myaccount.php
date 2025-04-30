<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location:login.php");
  exit;
}


if (isset($_GET['logout'])) {
  // Destroy the session
  session_destroy();
  // Redirect to the login page
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
    $error = "Missing information";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>My Account</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Click&Go</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="sponsors.html">Sponsors</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact</a></li>
          <a href="logout.php" class="btn btn-danger text-white">Logout</a>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <section class="section">
      <div class="container mt-5">
        <h5 class="fw-semibold mb-4">Modifier mes info</h5>
        <div class="card">
          <div class="card-body">
            <form action="" id="formr" method="post">
              <div class="mb-3">
                <label class="form-label">Nom :</label>
                <input type="text" class="form-control" value="<?= $user['nom'] ?>" id="nom" name="nom">
              </div>
              <div class="mb-3">
                <label class="form-label">Prenom :</label>
                <input type="text" class="form-control" value="<?= $user['prenom'] ?>" id="prenom" name="prenom">
              </div>
              <div class="mb-3">
                <label class="form-label">Age :</label>
                <input min=8 max=90 type="number" value="<?= $user['age'] ?>" class="form-control" id="age" name="age">
              </div>
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" value="<?= $user['email'] ?>" class="form-control" id="email" name="email">
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
              </div>
              <div class="mb-3">
                <label class="form-label">Type :</label>
                <select name="type" class="form-control" id="typeinput">
                  <option value="admin">admin</option>
                  <option value="client">client</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer mt-5 py-4 bg-light text-center">
    <div class="container">
      <p>&copy; 2025 Click&Go. All rights reserved.</p>
    </div>
  </footer>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
