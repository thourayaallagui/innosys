<?php
include __DIR__.'/../../Controller/Forumcontroller.php';
session_start();

$forumC = new Forumcontroller();
$list = $forumC->listForumsll2($order = 'desc'); // Récupération des sujets
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Click&Go</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="js/verfier.js"></script>
  <script src="js/verif2.js"></script>
  <script src="js/notification.js"></script>
  <audio id="notification-sound" src="not.mp3" preload="auto"></audio>

  <style>
    #notif-toast {
      position: fixed;
      bottom: 20px; /* met "top: 20px" pour en haut */
      right: 20px;
      background-color: #323232;
      color: #fff;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
      z-index: 9999;
      display: none;
      animation: fadeInOut 4s ease-in-out forwards;
      font-family: Arial, sans-serif;
    }

    @keyframes fadeInOut {
      0% { opacity: 0; transform: translateY(20px); }
      10% { opacity: 1; transform: translateY(0); }
      90% { opacity: 1; }
      100% { opacity: 0; transform: translateY(20px); }
    }
  </style>
</head>
<body>

<div id="notif-toast"></div>
<?php if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['titre'])): ?>
  <script>
    window.addEventListener("DOMContentLoaded", function() {
      const titre = "<?= htmlspecialchars($_GET['titre']) ?>";
      showToast(`✅ Le sujet « ${titre} » a été ajouté avec succès !`);
    });
  </script>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
  <script>
    window.addEventListener("DOMContentLoaded", function() {
      showToast("❌ Une erreur est survenue lors de l'ajout du sujet.");
    });
  </script>
<?php endif; ?>





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
        <li class="dropdown"><a href="#">Dropdown ▾</a></li>
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
  <div class="feature-card"><div class="icon">📺</div><h3>Lorem Ipsum</h3><p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p></div>
  <div class="feature-card"><div class="icon">💎</div><h3>Sed ut perspiciatis</h3><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p></div>
  <div class="feature-card"><div class="icon">📍</div><h3>Magni Dolores</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p></div>
  <div class="feature-card"><div class="icon">🔗</div><h3>Nemo Enim</h3><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p></div>
</section>

<section id="about" class="about-section">
  <div class="container">
    <h2 class="section-title">ABOUT US</h2>
    <p class="section-subtitle">Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    <div class="about-content">
      <div class="about-left">
        <p>Lorem ipsum dolor sit amet...</p>
        <ul>
          <li>✔️ Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
          <li>✔️ Duis aute irure dolor in reprehenderit in voluptate velit.</li>
          <li>✔️ Ullamco laboris nisi ut aliquip ex ea commodo</li>
        </ul>
      </div>
      <div class="about-right">
        <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
        <a href="#" class="btn-primary">Read More →</a>
      </div>
    </div>
    <div class="stats">
      <div class="stat"><h3>232</h3><p>Clients</p></div>
      <div class="stat"><h3>521</h3><p>Projects</p></div>
      <div class="stat"><h3>1 453</h3><p>Hours Of Support</p></div>
      <div class="stat"><h3>32</h3><p>Workers</p></div>
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
    <h2 class="forum-title">Forum</h2>
    <p class="forum-subtitle">
      Un espace pour poser des questions, partager des idées, organiser des événements, ou parler de divertissement. Rejoignez la discussion !
    </p>

    <div class="forum-card form-card">
      <h3 class="form-heading">Créer un sujet</h3>
      <form id="formForum" method="POST" action="addforum.php">
        <input type="text" name="titre" id="forumTitre" placeholder="Titre du sujet" />
        <div id="msg-titre" class="message-erreur"></div>

        <textarea name="contenu" id="forumContenu" placeholder="Contenu du sujet"></textarea>
        <div id="msg-contenu" class="message-erreur"></div>

        <input type="submit" value="Créer le sujet" class="btn-primary" />
      </form>
    </div>

    <?php if (!empty($list) && is_array($list)): ?>
      <?php foreach($list as $forum): ?>
        <div class="forum-card sujet-card">
          <div class="sujet-content">
            <h4><?= htmlspecialchars($forum['titre']) ?></h4>
            <p><?= nl2br(htmlspecialchars($forum['contenu'])) ?></p>
            <p class="date">Créé le : <?= date('d/m/Y H:i', strtotime($forum['date_creation'])) ?></p>

            <div class="forum-buttons">
              <a href="updateForum.php?id=<?= $forum['id'] ?>">Modifier</a>
              <a href="deleteForum.php?id=<?= $forum['id'] ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce forum ?');">Supprimer</a>
              <button class="btn btn-green" type="button" onclick="toggleCommentaire('commentaire-<?= $forum['id'] ?>')">Commentaires</button>
              <form action="likeForum.php" method="POST" class="like-form" style="display:inline;">
                <input type="hidden" name="forum_id" value="<?= $forum['id'] ?>">
                <button type="submit" class="btn-like">❤️ Like (<?= (int)$forum['likes'] ?>)</button>
              </form>
            </div>
          </div>

          <div class="commentaire-wrapper" id="commentaire-<?= $forum['id'] ?>" style="display: none;">
            <?php
              $forumId = $forum['id'];
              include 'showcom.php';
            ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucun sujet trouvé.</p>
    <?php endif; ?>
  </div>
</section>
<?php if (isset($_GET['liked']) && $_GET['liked'] == 1 && isset($_GET['titre'])): ?>
  <script>
    window.addEventListener("DOMContentLoaded", function() {
      const titre = "<?= htmlspecialchars($_GET['titre']) ?>";
      showToast(`❤️ Vous avez aimé le sujet « ${titre} »`);
    });
  </script>
<?php endif; ?>

<script>
function toggleCommentaire(id) {
  const section = document.getElementById(id);
  section.style.display = (section.style.display === "none") ? "block" : "none";
}
</script>

</body>
</html>
