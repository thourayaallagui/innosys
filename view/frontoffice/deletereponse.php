<?php
include __DIR__.'/../../Controller/ReponseController.php';


$reponseC = new ReponseController();

// Vérifier si l'ID du commentaire est fourni dans l'URL
if (isset($_GET['id_rep']) && !empty($_GET['id_rep'])) {
    $id_rep = $_GET['id_rep'];

    // Appel à la méthode de suppression
    $reponseC->deleteReponse($id_rep);

    // Redirection vers la page du forum après suppression
    header("Location: showforum.php?id=" . $_GET['id_com']); // redirection vers le sujet concerné
    exit();
} else {
    // Si aucun ID de commentaire n'est fourni
    echo "Erreur : ID du commentaire non fourni.";
    exit();
}
?>
