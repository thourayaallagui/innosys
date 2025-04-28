<?php
include __DIR__ . '/../../Controller/ReponseController.php';
$errorContenu = '';

$reponseC = new ReponseController();
$reponse = null;

if (isset($_GET['id_rep']) && !empty($_GET['id_rep'])) {
    $id_rep = $_GET['id_rep'];

    // Récupérer la réponse depuis la base
    $reponse = $reponseC->getReponseById($id_rep);
    if (!$reponse) {
        die("Erreur : La réponse n'existe pas.");
    }
} else {
    die("Erreur : ID de la réponse non fourni.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $contenu = trim($_POST['contenu'] ?? '');

  if (strlen($contenu) < 5) {
      $errorContenu = "Le commentaire doit contenir au moins 5 caractères.";
  }

  if (empty($errorContenu)) {
      // Créer un objet Reponse avec les bonnes données
      $updatedreponse = new Reponse($contenu, new DateTime(), $reponse['id_com'], $id_rep);

      // Appeler la mise à jour
      $reponseC->updateReponse($id_rep, $updatedreponse);

      // Redirection
      header("Location: showforum.php?id_com=" . $reponse['id_com']);
      exit();
  }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Click&Go - Modifier une réponse</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/verifier.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <header>
    <div class="container nav-bar">
      <h1 class="logo">Click&Go</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="#" class="active">Home</a></li>
          <li><a href="#about" class="active">About</a></li>
          <li><a href="#evenements" class="active">Événements</a></li>
          <li><a href="#forum">Forum</a></li>
          <li><a href="#">Team</a></li>
          <li class="dropdown">
            <a href="#">Dropdown ▾</a>
          </li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <a href="#" class="btn-primary">Get Started</a>
    </div>
  </header>

  <section class="hero">
    <h2><span>Welcome to </span><strong>Click&Go</strong></h2>
    <p>Your ultimate gateway to fun, adventure, and unforgettable experiences! 🎉</p>
    <a href="#" class="btn-primary">Get Started</a>
  </section>

  <section id="forum" class="forum-section">
    <div class="container forum-container">
      <h2 class="forum-title">Modifier la réponse</h2>
      <p class="forum-subtitle">Vous pouvez modifier le contenu de votre réponse ci-dessous :</p>

      <form action="updatereponse.php?id_rep=<?= $id_rep ?>" method="POST">
        <label for="contenu">Contenu</label><br>
        <textarea name="contenu" id="contenu" rows="5" cols="50"><?= htmlspecialchars($_POST['contenu'] ?? $reponse['contenu']) ?></textarea><br>
        <div class="message-erreur"><?= $errorContenu ?></div>
        <button type="submit">Mettre à jour</button>
      </form>
    </div>
  </section>

  <script src="js/verfier.js"></script>
  <script src="js/verif2.js"></script>
</body>
</html>
