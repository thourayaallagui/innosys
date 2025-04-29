<?php
include('../../controller/ReclamationC.php');
$ReclamationC = new ReclamationC();

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit();
}

$id = $_GET['id'];
$rec = $ReclamationC->findone($id);

if (!$rec) {
  echo "Réclamation introuvable.";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $objet = $_POST['objet'];
  $statut = 'En attente'; // You can adapt this if needed
  $date_creation = $rec['date_creation']; // Keep original date
  $user_id = 1;

  if (!empty($objet)) {
    $Reclamation = new Reclamation($date_creation, $objet, $statut, $user_id);
    $ReclamationC->update($Reclamation, $id);
    header("Location: index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Modifier Réclamation</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Click&Go</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Retour</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <section id="hero" class="hero section">
      <div class="container mt-5">
        <h3 class="text-center mb-4">Modifier la Réclamation</h3>
        <form method="POST" onsubmit="return validateForm();" class="row g-3 needs-validation" novalidate>
          <div class="col-md-12">
            <label for="objet" class="form-label">Objet de la réclamation</label>
            <input type="text" class="form-control" id="objet" name="objet" value="<?= htmlspecialchars($rec['objet']) ?>" required>
            <div class="invalid-feedback">
              Veuillez fournir un objet.
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Modifier</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
          </div>
        </form>
      </div>
      <script>
        function validateForm() {
          const objet = document.getElementById("objet").value.trim();
          if (objet === "") {
            alert("Veuillez saisir un objet.");
            return false;
          }
          return true;
        }
      </script>
    </section>
  </main>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>