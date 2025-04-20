
<?php
include __DIR__ . '/../../Controller/BlogController.php';

// Créer une instance du contrôleur
$blogController = new BlogController();

// Vérifier si l'ID est fourni dans l'URL
if (isset($_GET['id_blog']) && !empty($_GET['id_blog'])) {
    $id_blog = $_GET['id_blog'];

    // Appeler la fonction deleteBlog pour supprimer le blog
    $blogController->deleteBlog($id_blog);

    // Rediriger vers la liste des blogs après suppression
    header("Location: liste_blog.php");
    exit();
} else {
    // Si aucun ID n’est fourni
    echo "Erreur : ID du blog non fourni.";
    exit();
}
?>
