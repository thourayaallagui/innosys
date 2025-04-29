<?php
include __DIR__ . '/../../Controller/blogcontroller.php';

$error = '';
$blogC = new blogcontroller();

// Traitement du formulaire
if (
    isset($_POST['titre'], $_POST['contenu'], $_POST['date_publication'], $_POST['categorie'])
) {
    $blog = new Blog(
        $_POST['titre'],
        $_POST['contenu'],
        new DateTime($_POST['date_publication']),
        $_POST['categorie']
    );

    $blogC->addblog($blog);
    header("Location: showblog.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajouter un Blog</title>
  <link rel="stylesheet" href="css/style.css" />
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
        <span>Forms</span>
        <ul class="submenu">
          <li><a href="addblog.php">formulaire</a></li>
          <li><a href="showblog.php">Liste</a></li>
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
      <span>Hi, Hizrian</span>
    </div>
  </header>

  <div class="main-content">
    <h1>Ajouter un Blog</h1>
    <form action="" method="POST">
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" required minlength="3" maxlength="100">
        <span id="titre_error"></span><br>

        <label for="contenu">Contenu</label>
        <textarea id="contenu" name="contenu" required></textarea>
        <span id="contenu_error"></span><br>


        <label for="date_publication">Date de Publication</label>
        <input type="date" id="date_publication" name="date_publication" required min="<?= date(format: 'Y-m-d') ?>" max="<?= date('Y-m-d') ?>"><br><br>
        <span id="date_publication_error"></span><br>

        <label for="categorie">Catégorie</label>
        <select id="categorie" name="categorie" required>
    <option value="">-- Sélectionnez une catégorie --</option>
    <option value="Événement">Événement</option>
    <option value="Cinéma">Cinéma</option>
    <option value="Musique">Musique</option>
    <option value="Voyage">Voyage</option>
    <option value="Sport">Sport</option>
    <option value="Technologie">Technologie</option>
    <option value="Nature et Activités en plein air">Nature et Activités en plein air</option>
    <option value="Jeux vidéo">Jeux vidéo</option>
    <option value="Éducation et Apprentissage">Éducation et Apprentissage</option>
    <option value="Cuisine">Cuisine</option>
    <option value="Célébrations et Fêtes">Célébrations et Fêtes</option>
    <option value="Animaux">Animaux</option>
</select>
        <span id="categorie_error"></span><br>

        <button type="submit" class="btn btn-primary btn-user btn-block">
            Ajouter un Blog
        </button>
    </form>
  </div>
</div>
</body>
</html>
