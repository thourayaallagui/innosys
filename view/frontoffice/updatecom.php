<?php
include __DIR__ . '/../../Controller/CommentaireController.php';
$errorContenu = '';

$commentaireC = new CommentaireController();
$commentaire = null;

if (isset($_GET['id_com']) && !empty($_GET['id_com'])) {
    $id_com = $_GET['id_com'];

    // Récupérer le commentaire depuis la base
    $commentaire = $commentaireC->getCommentaireById($id_com);
    if (!$commentaire) {
        die("Erreur : Le commentaire n'existe pas.");
    }
} else {
    die("Erreur : ID du commentaire non fourni.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu'] ?? '');

    if (strlen($contenu) < 5) {
        $errorContenu = " Le commentaire doit contenir au moins 5 caractères.";
    }

    if (empty($errorContenu)) {
        // Mettre à jour le commentaire
        $updatedCommentaire = new Commentaire($contenu, new DateTime(), $commentaire['id']);
        $commentaireC->updateCommentaire($id_com, $updatedCommentaire);


        // Redirection vers le forum lié
        header("Location: showforum.php?id=" . $commentaire['id']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Click&Go</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/verifier.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<script src="js/verfier.js"></script>
  <header>
    <div class="container nav-bar">
      <h1 class="logo">Click&Go</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="#" class="active">Home</a></li>
          <li><a href="#about"class="active">About</a></li>

          <li><a href="#evenements" class="active">Événements</a></li>

          <li><a href="#forum">forum</a></li>
          <li><a href="#">Team</a></li>
          <li class="dropdown">
            <a href="#">Dropdown ▾</a>
            <!-- Dropdown content can go here -->
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
    <p>Click, explore, and let the good times roll!</p>
    <a href="#" class="btn-primary">Get Started</a>
  </section>

  <section class="features">
    <div class="feature-card">
      <div class="icon">📺</div>
      <h3>Lorem Ipsum</h3>
      <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
    </div>
    <div class="feature-card">
      <div class="icon">💎</div>
      <h3>Sed ut perspiciatis</h3>
      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
    </div>
    <div class="feature-card">
      <div class="icon">📍</div>
      <h3>Magni Dolores</h3>
      <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
    </div>
    <div class="feature-card">
      <div class="icon">🔗</div>
      <h3>Nemo Enim</h3>
      <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
    </div>
  </section>

  <script src="js/script.js"></script>
  <section id="about" class="about-section">
    <div class="container">
      <h2 class="section-title">ABOUT US</h2>
      <p class="section-subtitle">Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
  
      <div class="about-content">
        <div class="about-left">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <ul>
            <li>✔️ Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
            <li>✔️ Duis aute irure dolor in reprehenderit in voluptate velit.</li>
            <li>✔️ Ullamco laboris nisi ut aliquip ex ea commodo</li>
          </ul>
        </div>
        <div class="about-right">
          <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <a href="#" class="btn-primary">Read More →</a>
        </div>
      </div>
  
      <div class="stats">
        <div class="stat">
          <h3>232</h3>
          <p>Clients</p>
        </div>
        <div class="stat">
          <h3>521</h3>
          <p>Projects</p>
        </div>
        <div class="stat">
          <h3>1 453</h3>
          <p>Hours Of Support</p>
        </div>
        <div class="stat">
          <h3>32</h3>
          <p>Workers</p>
        </div>
      </div>
    </div>
  </section>

  <section id="evenements" class="evenements section-bg">
    <div class="container">
      <div class="section-title text-center">
        <h2>ÉVÉNEMENTS</h2>
        <p>Découvrez les événements à venir en Tunisie</p>
      </div>
  
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="event-box">
            <h4>E-FEST</h4>
            <img src="i1.jpg" alt="E-FEST" class="event-img">
            <p>Du 11 au 13 avril 2025 à Ksar El Ferch.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="event-box">
            <h4>Padel</h4>
            <img src="p2.png" alt="Padel" class="event-img">
            <p>Padel connection, 2073 Tunis.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="event-box">
            <h4>Congrès ATCMB</h4>
            <img src="m1.webp" alt="Congrès ATCMB" class="event-img">
            <p>11 avril 2025, Hôtel Les Oliviers Palace Sfax.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
 
 
 
<section id="forum" class="forum-section">
  <div class="container forum-container">
    <h2 class="forum-title">Forumer</h2>
    <p class="forum-subtitle">
      Un espace pour poser des questions, partager des idées, organiser des événements, ou parler de divertissement, publicité et loisirs. Rejoignez la discussion !
    </p>

  
    <div class="container">
        <h2>Modifier le Commentaire</h2>
        <form action="updateCom.php?id_com=<?= $id_com ?>" method="POST">
            <label for="contenu">Contenu</label><br>
            <textarea name="contenu" id="contenu" rows="5" cols="50"><?= htmlspecialchars($_POST['contenu'] ?? $commentaire['contenu']) ?></textarea><br>
            <div class="message-erreur"><?= $errorContenu ?></div>
            <button type="submit">Mettre à jour</button>
        </form>
        <script src="js/verif2.js"></script>
    </div>
       
  
  
  
  

</div>
    </div>
  </section>
  


  
   


