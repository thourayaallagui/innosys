<?php
require_once __DIR__ . '/../../Controller/AvisController.php';
require_once __DIR__ . '/../../Model/Avis.php';

$avisController = new AvisController();
$error = '';
$avis = null;

// Vérifie que l'ID est passé
if (isset($_GET['id_avis']) && !empty($_GET['id_avis'])) {
    $id_avis = $_GET['id_avis'];
    $avis = $avisController->getAvisById($id_avis);  // Assurez-vous que cette méthode existe pour récupérer un avis par ID.

    if (!$avis) {
        die("Erreur : L'avis n'existe pas.");
    }
} else {
    die("Erreur : ID de l'avis non fourni.");
}

// Traitement du formulaire de modification
if (isset($_POST['note'], $_POST['commentaire'], $_POST['date_avis'])) {
    $note = (int) $_POST['note'];
    $commentaire = $_POST['commentaire'];
    $date_avis = new DateTime($_POST['date_avis']);

    // Création l objet Avis avec les nouvelles informations
    $updatedAvis = new Avis($note, $commentaire, $date_avis, $id_avis);

    // Appel à la méthode updateAvis() pour mettre à jour l'avis dans la base de données
    $avisController->updateAvis($id_avis, $updatedAvis);

    // Rediriger après mise à jour
    header("Location: success_page.php");  // Remplacer par la page appropriée
    exit();
}
?>


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Modifier Avis - Click&Go</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .form-container {
      max-width: 600px;
      margin: 2rem auto;
      background: #fff;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 1rem;
    }
    input[type="number"],
    input[type="date"],
    textarea {
      width: 100%;
      padding: 0.6rem;
      margin-top: 0.4rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button[type="submit"] {
      margin-top: 1.5rem;
      padding: 0.7rem 1.5rem;
      background-color: #007bff;
      border: none;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
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
        <li><a href="blog.php">Blog</a></li>
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
    <h2 class="section-title">Modifier votre avis</h2>
    <div class="form-container">
      <form action="updateavis.php?id_avis=<?= htmlspecialchars($id_avis); ?>" method="POST">
        <label for="note">Note</label>
        <input type="number" id="note" name="note" min="1" max="5" value="<?= htmlspecialchars($avis['note']); ?>" required />

        <label for="commentaire">Commentaire</label>
        <textarea id="commentaire" name="commentaire" rows="5" required><?= htmlspecialchars($avis['commentaire']); ?></textarea>

        <label for="date_avis">Date de l'avis</label>
        <input type="date" id="date_avis" name="date_avis" value="<?= htmlspecialchars($avis['date_avis']); ?>" required min="<?= date(format: 'Y-m-d') ?>" max="<?= date('Y-m-d') ?>"><br><br>


        <button type="submit">Mettre à jour</button>
      </form>
    </div>
  </div>
</section>

<script src="script.js"></script>
</body>
</html>
