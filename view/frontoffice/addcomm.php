<?php
include __DIR__.'/../../Controller/CommentaireController.php';
$error = '';
$forum = null;
$commentaireC = new CommentaireController();

if (isset( $_POST['contenu'])) {
    $commentaire = new Commentaire(
        
        $_POST['contenu'],
        new DateTime()
    );

    // Appel à la fonction d'ajout
    $commentaireC->addCommentaire($commentaire);

    header("Location: showforum.php");
    exit();
} else {
    echo "Veuillez remplir tous les champs.";
}
?>