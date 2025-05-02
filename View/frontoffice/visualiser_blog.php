<?php
require_once __DIR__ . '/../../Controller/BlogController.php';

$blog = null;

if (isset($_GET['id_blog'])) {
    $id_blog = intval($_GET['id_blog']);
    $blogController = new BlogController();
    $blog = $blogController->getBlogById($id_blog);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Visualiser Blog - Click&Go</title>
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
          <li><a href="blogshow.php">blog</a></li>
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
        <?php
          $category = strtolower(trim($blog['categorie']));
          $imageRelativePath = 'ImagesBlogs/' . $category . '.jpg';
          $imageAbsolutePath = __DIR__ . '/ImagesBlogs/' . $category . '.jpg';

          if (!file_exists($imageAbsolutePath)) {
              $imageRelativePath = 'ImagesBlogs/default.jpg';
          }
        ?>
         <div class="blog-card">
              <img src="<?= $imageRelativePath ?>" alt="Image pour <?= htmlspecialchars($blog['categorie']) ?>" style="width:100%; max-height:350px; object-fit:cover; border-radius:8px; margin-bottom:15px;">
              <p><strong>Titre :</strong> <?= htmlspecialchars($blog['titre']) ?></p>
              <p><strong>Contenu :</strong>
                <?= isset($blog['contenu']) ? htmlspecialchars(substr($blog['contenu'], 0, 100)) . '...' : '<em>Non défini</em>' ?>
              </p>
              <p><strong>Catégorie :</strong> <?= htmlspecialchars($blog['categorie'] ?? 'Non défini') ?></p>
              <p><strong>Date de publication :</strong> 
    <?= htmlspecialchars(date('Y-m-d', strtotime($blog['date_publication']))) ?>
</p>


              <!-- Affichage moyenne des notes -->
              <?php if (isset($blog['moyenne_note']) && $blog['moyenne_note'] !== null): ?>
                <p><strong>Moyenne des notes :</strong> <?= round($blog['moyenne_note'], 2) ?>/5</p>
                <p>
                  <?php
                    $fullStars = floor($blog['moyenne_note']);
                    $halfStar = ($blog['moyenne_note'] - $fullStars >= 0.5);
                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

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

              <!-- Boutons -->
              <div class="blog-buttons">
                <a href="addavis.php?id_blog=<?= urlencode($blog['id_blog']) ?>" class="btn-primary">Ajouter un avis</a>
                <a href="showavis.php?id_blog=<?= urlencode($blog['id_blog']) ?>" class="btn-primary">Afficher les avis</a>
              </div>
            </div>
      <?php else: ?>
        <p class="warning">Aucun blog trouvé avec cet ID.</p>
      <?php endif; ?>
    </div>
  </section>

  <script src="script.js"></script>
</body>
</html>
