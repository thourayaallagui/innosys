<?php
include __DIR__.'/../../Controller/CommentaireController.php';
$error = '';
$forum = null;
$commentaireC = new CommentaireController();

if (isset($_POST['contenu']) && isset($_POST['id'])) {
    $forumId = intval($_POST['id']);
    $commentaire = new Commentaire(
        
        $_POST['contenu'],
       
        new DateTime(),
        $forumId 
       
       
    );

    // Appel à la fonction d'ajout
    $commentaireC->addCommentaire($commentaire);

    header("Location: showforum.php?id=" . $forumId);
    exit();
    
} else {
    echo "Veuillez remplir tous les champs.";
}
?>