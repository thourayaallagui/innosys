<?php
require_once __DIR__.'/../../Controller/BlogController.php';
require_once __DIR__.'/../../Model/Blog.php';

$error = '';
$blog = null;
$blogController = new BlogController();

// Vérifie que l'ID du blog est bien passé par l'URL
if (isset($_GET['id_blog']) && !empty($_GET['id_blog'])) {
    $id_blog = $_GET['id_blog'];
    $blog = $blogController->getBlogById($id_blog);

    if (!$blog) {
        die("Erreur : Le blog n'existe pas.");
    }
} else {
    die("Erreur : ID du blog non fourni.");
}

// Traitement du formulaire
if (
    isset($_POST['titre'], $_POST['contenu'], $_POST['nb_vues'], $_POST['nb_likes'], $_POST['date_publication'], $_POST['categorie'])
) {
    $updatedBlog = new Blog(
        $_POST['titre'],
        $_POST['contenu'],
        (int)$_POST['nb_vues'],
        (int)$_POST['nb_likes'],
        new DateTime($_POST['date_publication']),
        $_POST['categorie']
    );

    $blogController->updateBlog($id_blog, $updatedBlog);

    // Redirection après mise à jour
    header("Location: liste_blog.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier Blog</title>
    <link rel="stylesheet" href="css/style3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        form {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 1rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            margin-top: 1.5rem;
            padding: 0.7rem 1.5rem;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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
            <span>Hi,</span>
        </div>
    </header>

    <div class="main-content">
        <h1>Modifier le Blog</h1>
        <div class="breadcrumb">Forms &gt; Modifier</div>

        <form action="updateblog.php?id_blog=<?= htmlspecialchars($id_blog); ?>" method="POST">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($blog['titre']); ?>" required />

            <label for="contenu">Contenu</label>
            <textarea id="contenu" name="contenu" required><?= htmlspecialchars($blog['contenu']); ?></textarea>

            <label for="nb_vues">Nombre de vues</label>
            <input type="number" id="nb_vues" name="nb_vues" value="<?= (int)$blog['nb_vues']; ?>" required />

            <label for="nb_likes">Nombre de likes</label>
            <input type="number" id="nb_likes" name="nb_likes" value="<?= (int)$blog['nb_likes']; ?>" required />

            <label for="date_publication">Date de publication</label>
            <input type="date" id="date_publication" name="date_publication" value="<?= htmlspecialchars($blog['date_publication']); ?>" required />

            <label for="categorie">Catégorie</label>
            <input type="text" id="categorie" name="categorie" value="<?= htmlspecialchars($blog['categorie']); ?>" required />

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</div>
</body>
</html>