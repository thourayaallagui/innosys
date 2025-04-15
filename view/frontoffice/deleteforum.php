<?php
include __DIR__.'/../../Controller/ForumController.php';

// Créer une instance du contrôleur
$forumC = new ForumController();

// Vérifier si l'ID est fourni dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Appel à la méthode de suppression
    $forumC->deleteForum($id);

    // Redirection vers la page de liste des sujets après suppression
    header("Location: showForum.php");
    exit();
} else {
    // Si aucun ID n'est fourni
    echo "Erreur : ID du sujet non fourni.";
    exit();
}
?>
