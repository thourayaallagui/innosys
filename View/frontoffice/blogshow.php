<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config.php';
require_once __DIR__ . '/../../Controller/BlogController.php';
require_once __DIR__ . '/../../Controller/AvisController.php'; 
$pdo = config::getConnexion();

$blogController = new BlogController();
$avisController = new AvisController();
$order = isset($_GET['sort']) ? $_GET['sort'] : null;
$category = isset($_GET['categorie']) ? $_GET['categorie'] : null;
$sortByNote = isset($_GET['sort']) && $_GET['sort'] === 'note';
$list = $blogController->listBlogstri($order, $category, $sortByNote); 
$statsCategorie = $blogController->getNombreBlogsParCategorie();

foreach ($list as $index => $blog) {
    $list[$index]['moyenne_note'] = $avisController->calculerMoyenneParBlog($blog['id_blog']);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($newBlog)) {
  if ($blogController->addBlog($newBlog)) {
      header("Location: blogshow.php?notif=blog_ajoute");
      exit;
  } else {
      echo "<script>alert('Erreur lors de l\'ajout du blog.');</script>";
  }
}
session_start();

// Définir l’intervalle (par exemple : les dernières 24h)
$interval = date('Y-m-d H:i:s', strtotime('-24 hours'));

// Requête pour compter les blogs publiés dans les dernières 24h
$stmt = $pdo->prepare("SELECT COUNT(*) FROM blog WHERE date_publication >= ?");
$stmt->execute([$interval]);
$newBlogCount = $stmt->fetchColumn();
// Récupérer les blogs publiés dans les dernières 24h
$stmtTitles = $pdo->prepare("SELECT id_blog, titre FROM blog WHERE date_publication >= ?");
$stmtTitles->execute([$interval]);
$newBlogs = $stmtTitles->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
          <li><a href="blogshow.php">Blog</a></li>
          <li><a href="#">Team</a></li>
          <li class="dropdown"><a href="#">Dropdown ▾</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <div style="position: relative; margin-left: 20px;">
  <i class="fas fa-bell" style="font-size: 24px; color: #00cfff; cursor: pointer;" id="notificationBell"></i>
  <span id="notificationCount" style="
    position: absolute;
    top: -5px;
    right: -10px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 3px 6px;
    font-size: 12px;
    display: <?= ($newBlogCount > 0) ? 'inline-block' : 'none' ?>;
  "><?= $newBlogCount ?></span>

  <!-- Notifications box (cachée au début) -->
  <div id="notificationBox" style="
    display: none;
    position: absolute;
    top: 30px;
    right: -10px;
    width: 300px;
    background: white;
    border: 1px solid #ccc;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    border-radius: 8px;
    z-index: 1000;
    padding: 10px;
  ">
    <h4 style="margin-top: 0;">Nouveaux blogs</h4>
    <ul style="padding-left: 20px;">
<?php
if (!empty($newBlogs)) {
    foreach ($newBlogs as $blog) {
        $id = htmlspecialchars($blog['id_blog']);
        $titre = htmlspecialchars($blog['titre']);
        echo "<li style='margin-bottom: 5px;'>📝 <a href='visualiser_blog.php?id_blog=$id'>$titre</a></li>";
    }
} else {
    echo "<li>Aucun nouveau blog</li>";
}
?>
</ul>

  </div>
</div>

    </div>
  </header>

  <script>
// Demander la permission d'afficher des notifications au chargement
document.addEventListener("DOMContentLoaded", function () {
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    // Exemple simple : détecter via paramètre d'URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('notif') === 'blog_ajoute') {
        showNotification("Nouveau blog ajouté", "Un nouvel article a été publié avec succès !");
    }
});

function showNotification(title, message) {
    if (Notification.permission === "granted") {
        new Notification(title, {
            body: message,
            icon: "icons/blog.png" // optionnel, ajoute une icône
        });
    }
}
</script>

  <style>
    /* Styles pour le formulaire de tri */
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

    /* Styles pour la section des blogs */
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
      margin: 20px 0;
    }

    .blog-section .container {
      width: 50%;
      margin: 0 auto;
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
    <button type="submit" class="btn-primary">
      <i class="fas fa-search"></i>
    </button>
    <label for="sort">Trier par date ou par note moyenne :</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
      <option value="">-- Choisir --</option>
      <option value="asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : '' ?>>Date croissante</option>
      <option value="desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>Date décroissante</option>
      <option value="note" <?= (isset($_GET['sort']) && $_GET['sort'] == 'note') ? 'selected' : '' ?>>Moyenne des notes</option>
    </select>

<!-- Ajout du bouton pour afficher le graphique -->
<button type="button" class="btn-primary" id="showChartButton">
Découvrir les stats des blogs par catégorie 📊 
</button>

</form>

<section class="blog-section">
    <div class="container">
      <?php if (!empty($statsCategorie)): ?>

        <!-- Graphique caché initialement -->
        <div id="chartContainer" style="display:none; margin-top: 40px;">
          <canvas id="categoryChart" style="max-height: 400px;"></canvas>
        </div>

        <script>
          // Ajouter un événement au bouton pour afficher le graphique
          document.getElementById('showChartButton').addEventListener('click', function() {
            var chartContainer = document.getElementById('chartContainer');
            // Afficher le graphique lorsqu'on clique sur le bouton
            chartContainer.style.display = chartContainer.style.display === 'none' ? 'block' : 'none';

            // Si le graphique est déjà affiché, on le redessine
            if (chartContainer.style.display === 'block') {
              const totalBlogs = <?= array_sum(array_column($statsCategorie, 'total')) ?>;
              const categoryCounts = <?= json_encode(array_column($statsCategorie, 'total')) ?>;
              const categoryLabels = <?= json_encode(array_column($statsCategorie, 'categorie')) ?>;

              const categoryPercentages = categoryCounts.map(count => (count / totalBlogs * 100).toFixed(2));

              const ctx = document.getElementById('categoryChart').getContext('2d');
              const categoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: categoryLabels,
                  datasets: [{
                    label: 'Nombre de blogs',
                    data: categoryCounts,
                    backgroundColor: 'rgba(0, 207, 255, 0.6)',
                    borderColor: '#00cfff',
                    borderWidth: 1,
                    borderRadius: 8
                  }]
                },
                options: {
                  responsive: true,
                  plugins: {
                    legend: { display: false },
                    title: {
                      display: true,
                      text: 'Stat des blogs par catégorie'
                    },
                    tooltip: {
                      callbacks: {
                        label: function(tooltipItem) {
                          const index = tooltipItem.dataIndex;
                          return `${categoryLabels[index]}: ${categoryCounts[index]} blogs (${categoryPercentages[index]}%)`;
                        }
                      }
                    }
                  },
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: { stepSize: 1 }
                    }
                  }
                }
              });
            }
          });
        </script>

      <?php endif; ?>

      <h2 class="section-title">Nos Derniers Blogs</h2>
      <div class="blog-list">
        <?php if (!empty($list)): ?>
          <?php foreach ($list as $blog): ?>
            <?php
            $category = strtolower(trim($blog['categorie'])); // ex: "Cinéma" => "cinéma"
            $imageRelativePath = 'ImagesBlogs/' . $category . '.jpg';
            $imageAbsolutePath = __DIR__ . '/ImagesBlogs/' . $category . '.jpg';

            if (!file_exists($imageAbsolutePath)) {
                $imageRelativePath = 'ImagesBlogs/default.jpg'; // image par défaut si l’image spécifique n’existe pas
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
          <?php endforeach; ?>
        <?php else: ?>
          <p>Aucun blog disponible pour le moment.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <script src="script.js"></script>
  <script>
document.addEventListener("DOMContentLoaded", function () {
    const bell = document.getElementById("notificationBell");
    const box = document.getElementById("notificationBox");
    const badge = document.getElementById("notificationCount");

    bell.addEventListener("click", function (e) {
        e.stopPropagation(); // Empêche la fermeture immédiate
        box.style.display = box.style.display === "none" ? "block" : "none";
        if (badge) badge.style.display = "none"; // Masquer le badge au clic
    });

    // Clique en dehors de la boîte : la fermer
    document.addEventListener("click", function () {
        box.style.display = "none";
    });

    // Empêche fermeture si on clique dans la boîte
    box.addEventListener("click", function (e) {
        e.stopPropagation();
    });
});
</script>



</body>
</html>
