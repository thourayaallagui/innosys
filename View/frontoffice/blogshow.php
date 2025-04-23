<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../Controller/BlogController.php';

$blogController = new BlogController();
$order = isset($_GET['sort']) ? $_GET['sort'] : null;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$list = $blogController->listBlogs($order, $category);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blog - Click&Go</title>
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
          <li><a href="blog.php" class="active">Blog</a></li>
          <li><a href="#">Team</a></li>
          <li class="dropdown"><a href="#">Dropdown ▾</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <a href="#" class="btn-primary">Get Started</a>
    </div>
  </header>
  <style>
  .sort-form {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px auto;
    gap: 10px;
    font-size: 16px;
    font-family: 'Arial', sans-serif;
  }

  .sort-form label {
    font-weight: 600;
    color: #333;
  }

  .sort-form select {
    padding: 6px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    cursor: pointer;
    transition: border-color 0.3s, box-shadow 0.3s;
  }

  .sort-form select:focus {
    outline: none;
    border-color: #00cfff;
    box-shadow: 0 0 5px rgba(0, 207, 255, 0.5);
  }

  .blog-section {
  padding: 46px 20px;
}

.blog-list {
  flex-direction: column;
  gap: 30px;
  align-items: center;
}

.blog-card {
  width: 100%;
  margin: 0 auto;
  padding: 30px;
  background-color: #fff;
  border-radius: 0;
  box-shadow: none;
  border-bottom: 1px solid #eee;
}


.blog-card p {
  margin: 10px 0;
}

.blog-buttons {
  display: flex;
  gap: 15px;
  margin-top: 15px;
  flex-wrap: wrap;
}

.blog-buttons a.btn-primary {
  background-color: #00cfff;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s;
  display: inline-block;
  text-align: center;
}

.blog-buttons a.btn-primary:hover {
  background-color: #009ec3;
}

</style>

<form method="GET" class="sort-form">
  <label for="category">Rechercher par catégorie :</label>
  <input type="text" name="category" id="category" placeholder="Ex: Voyage" value="<?= isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '' ?>">
  <button type="submit" class="btn-primary">
    <i class="fas fa-search"></i> <!-- Icône de recherche -->
  </button>
  <label for="sort">Trier par date :</label>
  <select name="sort" id="sort" onchange="this.form.submit()">
    <option value="">-- Choisir --</option>
    <option value="asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : '' ?>>Date croissante</option>
    <option value="desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>Date décroissante</option>
  </select>

</form>
  <section class="blog-section">
    <div class="container">
      <h2 class="section-title">Nos Derniers Blogs</h2>
      <div class="blog-list">
        <?php if (!empty($list)): ?>
            <?php foreach ($list as $blog): ?>
  <div class="blog-card">
    <p><strong>Titre :</strong> <?= htmlspecialchars($blog['titre']) ?></p>
    <p><strong>Contenu :</strong> <?= isset($blog['contenu']) ? htmlspecialchars(substr($blog['contenu'], 0, 100)) . '...' : '<em>Non défini</em>' ?></p>
    <p><strong>Catégorie :</strong> <?= isset($blog['categorie']) ? htmlspecialchars($blog['categorie']) : '<em>Non défini</em>' ?></p>
    <p><strong>Date de publication :</strong> <?= htmlspecialchars($blog['date_publication']) ?></p>

    <!-- Bouton Ajouter un avis avec lien vers la page d'ajout en passant l'ID du blog -->
    <div class="blog-buttons">
  <a href="addavis.php?id_blog=<?= urlencode($blog['id_blog']) ?>" class="btn-primary">Ajouter un avis</a>
  <a href="showavis.php?id_blog=<?= urlencode($blog['id_blog']) ?>" class="btn-primary">Afficher les avis</a>
</div>
  </div>
<?php endforeach; ?>

        <?php else: ?>
          <p>Aucun blog disponible pour le moment.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <script src="script.js"></script>
</body>
</html>
