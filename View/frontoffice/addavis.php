<?php
require_once __DIR__ . '/../../Controller/AvisController.php';
require_once __DIR__ . '/../../Model/avis.php';

$error = '';
$avisC = new AvisController();

if (
    isset($_POST['note'], $_POST['commentaire'], $_POST['date_avis'], $_POST['id_blog'])
) {
    $avis = new Avis(
        intval($_POST['note']),
        $_POST['commentaire'],
        new DateTime($_POST['date_avis']),
        intval($_POST['id_blog'])
    );

    $avisC->addAvis($avis);
    header("Location: showblog.php");
    exit();
}

// Vérifie qu'on a bien un id_blog dans l'URL
if (!isset($_GET['id_blog'])) {
    echo "Aucun blog sélectionné.";
    exit();
}

$id_blog = intval($_GET['id_blog']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajouter un Avis - Click&Go</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <header>
    <div class="container nav-bar">
      <h1 class="logo">Click&Go</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="index.html#about">About</a></li>
          <li><a href="index.html#evenements">Événements</a></li>
          <li><a href="blog.php" class="active">Blog</a></li>
          <li><a href="#">Team</a></li>
          <li class="dropdown"><a href="#">Dropdown ▾</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <a href="#" class="btn-primary">Get Started</a>
    </div>
  </header>

  <section class="blog-section">
    <div class="container">
      <h2 class="section-title">Ajouter un Avis</h2>
      <div class="blog-card">
        <form action="" method="POST" class="form-avis">
          <input type="hidden" name="id_blog" value="<?= htmlspecialchars($id_blog) ?>">

          <label for="note"><strong>Note :</strong></label><br>
          <input type="number" name="note" min="0" max="5" required><br><br>

          <label for="commentaire"><strong>Commentaire :</strong></label><br>
          <textarea name="commentaire" rows="4" cols="50" required></textarea><br><br>

          <label for="date_avis"><strong>Date de l'avis :</strong></label><br>
          <input type="date" name="date_avis" required min="<?= date(format: 'Y-m-d') ?>" max="<?= date('Y-m-d') ?>"><br><br>

          <input type="submit" value="Ajouter" class="btn-primary">
        </form>
      </div>
    </div>
  </section>

  <script src="script.js"></script>
</body>
</html>
