<?php
require_once __DIR__ . '/../../Controller/AvisController.php';
require_once __DIR__ . '/../../Controller/BlogController.php';

$avisList = [];
$blog = null;

if (isset($_GET['id_blog'])) {
    $id_blog = intval($_GET['id_blog']);

    $avisController = new AvisController();
    $avisList = $avisController->getAvisByBlogId($id_blog);
    $moyenneNote = $avisController->calculerMoyenneParBlog($id_blog);

    $blogController = new BlogController();
    $blog = $blogController->getBlogById($id_blog); // Cette fonction doit exister
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Avis - Click&Go</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      <?php if ($blog): ?>
        <div class="blog-card">
          <h2 class="section-title">Blog </h2>
          <p><strong>Titre :</strong> <?= htmlspecialchars($blog['titre']) ?></p>
          <p><strong>Contenu :</strong> <?= htmlspecialchars(substr($blog['contenu'], 0, 150)) ?>...</p>
          <p><strong>Catégorie :</strong> <?= htmlspecialchars($blog['categorie']) ?></p>
          <p><strong>Date de publication :</strong> <?= htmlspecialchars($blog['date_publication']) ?></p>
          <?php if ($moyenneNote !== null): ?>
  <p><strong>Moyenne des notes :</strong> <?= round($moyenneNote, 2) ?>/5</p>
  <p>
    <?php
      $fullStars = floor($moyenneNote); // Étoiles pleines
      $halfStar = ($moyenneNote - $fullStars >= 0.5) ? true : false; // Étoile à moitié
      $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Étoiles vides

      for ($i = 0; $i < $fullStars; $i++) {
          echo '<i class="fas fa-star" style="color: gold;"></i>';
      }

      if ($halfStar) {
          echo '<i class="fas fa-star-half-alt" style="color: gold;"></i>';
      }

      for ($i = 0; $i < $emptyStars; $i++) {
          echo '<i class="far fa-star" style="color: gold;"></i>';
      }
    ?>
  </p>
<?php else: ?>
  <p><strong>Moyenne des notes :</strong> Aucun avis pour le moment</p>
<?php endif; ?>


        </div>
      <?php else: ?>
        <p class="warning">Aucun blog trouvé avec cet ID.</p>
      <?php endif; ?>

      <h2 class="section-title">Avis des utilisateurs</h2>
      <div class="blog-list">
        <?php if (!empty($avisList)): ?>
          <?php foreach ($avisList as $avis): ?>
            <div class="blog-card" style="position: relative;">
              <p><strong>Note :</strong> <?= htmlspecialchars($avis['note']) ?>/5</p>
              <p><strong>Commentaire :</strong> <?= htmlspecialchars($avis['commentaire']) ?></p>
              <p><strong>Date :</strong> <?= htmlspecialchars($avis['date_avis']) ?></p>
              
              <!-- Icône de suppression -->
              <a href="deleteavis.php?id_avis=<?= $avis['id_avis'] ?>&id_blog=<?= $id_blog ?>"
                 onclick="return confirm('Voulez-vous vraiment supprimer cet avis ?')"
                 title="Supprimer l'avis"
                 style="position: absolute; top: 10px; right: 10px; color: red;">
                <i class="fas fa-trash"></i>
              </a>

              <!-- Icône de modification -->
              <a href="updateavis.php?id_avis=<?= $avis['id_avis'] ?>&id_blog=<?= $id_blog ?>"
                 title="Modifier l'avis"
                 style="position: absolute; top: 10px; right: 40px; color: #007BFF;">
                <i class="fas fa-edit"></i>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun avis pour ce blog pour le moment.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <script src="script.js"></script>
</body>
</html>
