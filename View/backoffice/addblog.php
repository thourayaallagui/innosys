<?php
include __DIR__ . '/../../Controller/blogcontroller.php';

$error = '';
$blogC = new blogcontroller();

// Traitement du formulaire
if (
    isset($_POST['titre'], $_POST['contenu'], $_POST['nb_vues'], $_POST['nb_likes'], $_POST['date_publication'], $_POST['categorie'])
) {
    $blog = new Blog(
        $_POST['titre'],
        $_POST['contenu'],
        intval($_POST['nb_vues']),
        intval($_POST['nb_likes']),
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
          <li><a href="formulaire.html">formulaire</a></li>
          <li><a href="liste.html">Liste</a></li>
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
        <input type="text" id="titre" name="titre" required>
        <span id="titre_error"></span><br>

        <label for="contenu">Contenu</label>
        <textarea id="contenu" name="contenu" required></textarea>
        <span id="contenu_error"></span><br>

        <label for="nb_vues">Nombre de Vues</label>
        <input type="number" id="nb_vues" name="nb_vues" required>
        <span id="nb_vues_error"></span><br>

        <label for="nb_likes">Nombre de Likes</label>
        <input type="number" id="nb_likes" name="nb_likes" required>
        <span id="nb_likes_error"></span><br>

        <label for="date_publication">Date de Publication</label>
        <input type="date" id="date_publication" name="date_publication" required>
        <span id="date_publication_error"></span><br>

        <label for="categorie">Catégorie</label>
        <input type="text" id="categorie" name="categorie" required>
        <span id="categorie_error"></span><br>

        <button type="submit" class="btn btn-primary btn-user btn-block">
            Ajouter un Blog
        </button>
    </form>
  </div>
</div>
</body>
</html>
