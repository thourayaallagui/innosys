
<?php
include __DIR__ . '/../../Controller/BlogController.php';


$blogController = new BlogController();


if (isset($_GET['id_blog']) && !empty($_GET['id_blog'])) {
    $id_blog = $_GET['id_blog'];

    
    $blogController->deleteBlog($id_blog);

    
    header("Location: showblog.php");
    exit();
} else {
    
    echo "Erreur : ID du blog non fourni.";
    exit();
}
?>
