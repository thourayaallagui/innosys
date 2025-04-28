<?php
include __DIR__.'/../../Controller/CommentaireController.php';

// Créer une instance du contrôleur
$commentaireC = new CommentaireController();

// Vérifier si l'ID du commentaire est fourni dans l'URL
if (isset($_GET['id_com']) && !empty($_GET['id_com'])) {
    $id_com = $_GET['id_com'];

    // Appel à la méthode de suppression
    $commentaireC->deleteCommentaire($id_com);

    // Redirection vers la page du forum après suppression
    header("Location: showforum.php?id=" . $_GET['id']); // redirection vers le sujet concerné
    exit();
} else {
    // Si aucun ID de commentaire n'est fourni
    echo "Erreur : ID du commentaire non fourni.";
    exit();
}
?>
