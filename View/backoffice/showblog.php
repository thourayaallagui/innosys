<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/../../Controller/BlogController.php';

$blogController = new BlogController();
$list = $blogController->listBlogs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Liste des Blogs</title>
  <link rel="stylesheet" href="css/style3.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    .action-icons i {
      font-size: 1.2rem;
      cursor: pointer;
      transition: transform 0.2s;
    }
    .action-icons i:hover {
      transform: scale(1.2);
    }
    .edit-icon {
      color: #007bff;
      margin-right: 10px;
    }
    .delete-icon {
      color: red;
    }
  </style>
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
          <li><a href="formulaire_blog.php">Formulaire Blog</a></li>
          <li><a href="liste_blog.php">Liste</a></li>
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
        <span>Hi, </span>
      </div>
    </header>

    <div class="main-content">
      <h1>Liste des Blogs</h1>
      <div class="breadcrumb">Forms &gt; Liste</div>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Titre</th>
              <th>Contenu</th>
              <th>Date</th>
              <th>Catégorie</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $blog): ?>
              <tr>
                <td><?= htmlspecialchars($blog['titre']); ?></td>
                <td><?= htmlspecialchars($blog['contenu']); ?></td>
                <td><?= htmlspecialchars($blog['date_publication']); ?></td>
                <td><?= htmlspecialchars($blog['categorie']); ?></td>
                <td class="action-icons">
  <?php if (!empty($blog['id_blog'])): ?>
    <a href="updateblog.php?id_blog=<?php echo $blog['id_blog']; ?>" title="Modifier">
      <i class="fa-solid fa-pen-to-square edit-icon"></i>
    </a>
    <a href="deleteblog.php?id_blog=<?= $blog['id_blog']; ?>" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce blog ?');">
      <i class="fa-solid fa-trash delete-icon"></i>
    </a>
  <?php else: ?>
    <span>Aucun ID</span>
  <?php endif; ?>
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
