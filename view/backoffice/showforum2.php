<?php
include __DIR__ . '/../../Controller/Forumcontroller.php';
include_once __DIR__ . '/../../Controller/CommentaireController.php';

$forumC = new Forumcontroller();
$commentaireC = new CommentaireController();

// Détection du tri
$sortBy = $_GET['sort_by'] ?? 'date_creation';
$sortOrder = $_GET['sort_order'] ?? 'desc';
$newSortOrder = $sortOrder === 'asc' ? 'desc' : 'asc';
$search = $_GET['search'] ?? '';

// Récupérer les forums triés
$list = $forumC->listForumsl($sortBy, $sortOrder);
if (!empty($search)) {
  $list = array_filter($list, function ($forum) use ($search) {
      return stripos($forum['contenu'], $search) !== false;
  });
}
?>

<!DOCTYPE html>
<html lang="fr">
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
  <h2 class="dashboard-title">Tableau de bord</h2>
  <ul class="nav">
    <li><a href="index.html">Tableau de bord</a></li>
    <li class="section-title">COMPOSANTS</li>
    <li><a href="#">Base</a></li>
    <li><a href="#">Dispositions de la barre latérale</a></li>
    <li class="active">
      <span>Forum</span>
      <ul class="submenu">
        <li><a href="#">Liste Sujets</a></li>
      </ul>
    </li>
    <li><a href="#">Tableaux</a></li>
    <li><a href="#">Cartes</a></li>
    <li><a href="#">Graphiques</a></li>
  </ul>
</div>

<div class="main">
  <header class="topbar">
  <form method="get" action="">
      <input type="text" name="search" placeholder="Recherche dans le contenu..." value="<?= htmlspecialchars($search) ?>" style="padding: 6px; width: 250px;" />
      <input type="hidden" name="sort_by" value="<?= $sortBy ?>">
      <input type="hidden" name="sort_order" value="<?= $sortOrder ?>">
      <button type="submit" style="padding: 6px 10px;">🔍 Rechercher</button>
    </form>
    <div class="topbar-right">
      <span>Bonjour, administrateur</span>
    </div>
  </header>

  <div class="main-content">
    <h1>Liste des sujets</h1>
    <div class="breadcrumb">Tableau de bord &gt; Forum</div>

    <!-- TRI -->
    <form method="get" action="" style="margin-bottom: 20px;">
      <label for="sort_by">Trier par :</label>
      <select name="sort_by" id="sort_by" style="padding: 5px;">
        <option value="date_creation" <?= $sortBy === 'date_creation' ? 'selected' : '' ?>>Date de création</option>
        <option value="likes" <?= $sortBy === 'likes' ? 'selected' : '' ?>>Nombre de likes❤️</option>
        <option value="titre" <?= $sortBy === 'titre' ? 'selected' : '' ?>>Titre</option>
      </select>
      <input type="hidden" name="sort_order" value="<?= $newSortOrder ?>">
      <button type="submit" style="padding: 8px 12px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Ordre : <?= $sortOrder === 'asc' ? '⬆️ croissant' : '⬇️ décroissant' ?>
      </button>
    </form>

    <!-- AFFICHAGE DES SUJETS -->
    <div class="forum-section">
      <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #fff;">
        <thead style="background-color: #007BFF; color: white;">
          <tr>
            <th style="padding: 12px; border: 1px solid #ddd;">Titre</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Contenu</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Date de création</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Likes </th>
            <th style="padding: 12px; border: 1px solid #ddd;">Commentaires</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Réponses</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list as $forum): ?>
            <tr style="border-bottom: 1px solid #ccc;">
              <td style="padding: 10px; border: 1px solid #ddd; color: #007BFF; font-weight: bold;">
                <?= htmlspecialchars($forum['titre']) ?>
              </td>
              <td style="padding: 10px; border: 1px solid #ddd;">
                <?= nl2br(htmlspecialchars($forum['contenu'])) ?>
              </td>
              <td style="padding: 10px; border: 1px solid #ddd;">
                <?= date('d/m/Y H:i', strtotime($forum['date_creation'])) ?>
              </td>
              <td style="padding: 10px; border: 1px solid #ddd;">
                <?= htmlspecialchars($forum['likes']) ?>
              </td>
              <td style="padding: 10px; border: 1px solid #ddd; background-color: #f3faff;">
                <?php
                  $_GET['id'] = $forum['id'];
                  include 'showcom2.php';
                ?>
              </td>
              <td style="padding: 10px; border: 1px solid #ddd; background-color: #f9f9ff;">
                <?php
                  $commentaires = $commentaireC->listCommentaires();
                  foreach ($commentaires as $commentaire) {
                    if ($commentaire['id'] == $forum['id']) {
                      $_GET['id_com'] = $commentaire['id_com'];
                      include 'showrep.php';
                    }
                  }
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
