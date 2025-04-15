<?php
include __DIR__.'/../../Controller/Forumcontroller.php';

$forumC = new Forumcontroller();
$list = $forumC->listForums(); // méthode qui retourne tous les sujets du forum
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Liste des Sujets du Forum</title>
  <link rel="stylesheet" href="css/style3.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="sidebar">
  <div class="logo">
    <img src="img/lo.png" alt="Logo" />
  </div>
  <h2 class="dashboard-title">Dashboard</h2>
  <ul class="nav">
    <li><a href="index.html">Dashboard</a></li>
    <li class="section-title">COMPONENTS</li>
    <li><a href="#">Base</a></li>
    <li><a href="#">Sidebar Layouts</a></li>
    <li class="active">
      <span>Forum</span>
      <ul class="submenu">
        <li><a href="#">Liste Sujets</a></li>
      </ul>
    </li>
    <li><a href="#">Tables</a></li>
    <li><a href="#">Maps</a></li>
    <li><a href="#">Charts</a></li>
  </ul>
</div>

<div class="main">
  <header class="topbar">
    <input type="text" placeholder="Search..." />
    <div class="topbar-right">
      <span>Hi, Admin</span>
    </div>
  </header>

  <div class="main-content">
    <h1>Liste des Sujets</h1>
    <div class="breadcrumb">Dashboard &gt; Forum</div>

    <div class="forum-section">
    <?php foreach($list as $forum): ?>
  <div class="forum-card">
    <h4><?= htmlspecialchars($forum['titre']) ?></h4>
    <p><?= nl2br(htmlspecialchars($forum['contenu'])) ?></p>
    <p class="date">Créé le : <?= date('d/m/Y H:i', strtotime($forum['date_creation'])) ?></p>
   
  </div>
<?php endforeach; ?>


    </div>

  </div>
</div>

</body>
</html>
