<?php
include __DIR__.'/../../Controller/ReclamController.php';

$reclamationController = new ReclamController();
$reclamations = $reclamationController->listReclamations();
?>




<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Click&Go</title>
  <link rel="stylesheet" href="css/style.css" />
  
 

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
           <a href="#reclamation">Réclamation</a></li>
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

<!-- Formulaire dans une carte -->
<div class="forum-card form-card">
      <h3 class="form-heading">Créer une reclamation</h3>
      <form id="formForum" class="formulaire" method="POST" action="ajout.php">
      <div class="form-group">
      <label for="date_creation">Date :</label>
      <input type="date" id="date_creation" name="date_creation" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <br>
      <label for="objet">Objet :</label>
      <input type="text" id="objet" name="objet" required>
      <br>
      <label for="statut">Statut :</label>
      <select id="statut" name="statut" required>
        <option value="En attente">En attente</option>
        <option value="En cours">En cours</option>
        <option value="Résolue">Résolue</option>
      </select>
      <br>
      <br>
      <label for="nom_utilisateur">Nom d'utilisateur :</label>
      <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
    

        <input type="submit" value="Créer une reclamation " class="btn-primary" />
      </form>
    </div>
<!-- Affichage des réclamations dans des cartes -->
<?php foreach ($reclamations as $reclamation): ?>
  <div class="forum-card sujet-card">
  <div class="sujet-content">
    <h3>Réclamation #<?php echo htmlspecialchars($reclamation['id_reclamation']); ?></h3>
    <div class="reclam-info"><span>Date :</span> <?php echo htmlspecialchars($reclamation['date_creation']); ?></div>
    
   
    <div class="reclam-info"><span>Objet :</span> <?php echo htmlspecialchars($reclamation['objet']); ?></div>
   
    <div class="reclam-info"><span>Statut :</span> <?php echo htmlspecialchars($reclamation['statut']); ?></div>
   
    <div class="reclam-info"><span>Nom utilisateur :</span> <?php echo htmlspecialchars($reclamation['nom_utilisateur']); ?></div>

    <div class="forum-buttons">
      <a href="modifier.php?id=<?php echo $reclamation['id_reclamation']; ?>"class="edit">Modifier</a>
      <a href="supprimer.php?id=<?php echo $reclamation['id_reclamation']; ?>" class="delete">Supprimer</a>
    </div>
    
  </div>
  </div>
  </div>
  
<?php endforeach; ?>


<div class="forum-card form-card">
  <h3 class="form-heading">Modifier une réclamation</h3>
  <form id="formForum" class="formulaire" method="POST" action="modifier.php?id=<?php echo $reclamation['id_reclamation']; ?>">
    <div class="form-group">
      <label for="date_creation">Date :</label>
      <input type="date" id="date_creation" name="date_creation" value="<?php echo htmlspecialchars($reclamation['date_creation']); ?>" required>
    </div>
    <br>
    <label for="objet">Objet :</label>
    <input type="text" id="objet" name="objet" value="<?php echo htmlspecialchars($reclamation['objet']); ?>" required>
    <br>
    <label for="statut">Statut :</label>
    <select id="statut" name="statut" required>
      <option value="En attente" <?php if ($reclamation['statut'] == "En attente") echo 'selected'; ?>>En attente</option>
      <option value="En cours" <?php if ($reclamation['statut'] == "En cours") echo 'selected'; ?>>En cours</option>
      <option value="Résolue" <?php if ($reclamation['statut'] == "Résolue") echo 'selected'; ?>>Résolue</option>
    </select>
    <br><br>
    <label for="nom_utilisateur">Nom d'utilisateur :</label>
    <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?php echo htmlspecialchars($reclamation['nom_utilisateur']); ?>" required>
    <br><br>
    <input type="submit" value="Mettre à jour la réclamation" class="btn-primary" />
    <a href="reclamationview.php" class="btn-secondary">Annuler</a>
  </form>
</div>







<?php 
$reclamations = $reclamationController->listReclamationsWithReponse();
foreach ($reclamations as $reclamation): ?>
<div class="forum-card sujet-card">
    <div class="sujet-content">
        <h3>Réclamation #<?= htmlspecialchars($reclamation['id_reclamation']) ?></h3>
        <div class="reclam-info">
            <span>Date :</span> <?= htmlspecialchars($reclamation['date_creation']) ?>
        </div>
        <div class="reclam-info">
            <span>Objet :</span> <?= htmlspecialchars($reclamation['objet']) ?>
        </div>
        <div class="reclam-info">
            <span>Statut :</span> <?= htmlspecialchars($reclamation['statut']) ?>
        </div>
        <div class="reclam-info">
            <span>Nom utilisateur :</span> <?= htmlspecialchars($reclamation['nom_utilisateur']) ?>
        </div>
        <?php if (!empty($reclamation['id_reponse'])): ?>
        <div class="reclam-info">
            <span>Réponse :</span> <?= htmlspecialchars($reclamation['reponse_contenu']) ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

 
<form method="POST" action="?action=add_reponse">
    <input type="hidden" name="id_reclamation" value="<?= $reclamation['id_reclamation'] ?>">
    <div class="form-group">
        <label>Réponse :</label>
        <textarea name="contenu" required></textarea>
    </div>
    <button type="submit" class="btn-primary">Ajouter une réponse</button>
</form>
</body>
</html>
