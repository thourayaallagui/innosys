<?php
include __DIR__ . '/../../Controller/CommentaireController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_com'])) {
    $commentaireC = new CommentaireController();
    $ComId = $_POST['id_com'];

    // Récupérer les informations du commentaire
    $commentaire = $commentaireC->getCommentaireById($ComId);

    if ($commentaire) {
        // Incrémenter le nombre de likes
        $newLikes = $commentaire['likes2'] + 1;

        // Mettre à jour le nombre de likes dans la base de données
        $sql = "UPDATE commentaire SET likes2 = :likes2 WHERE id_com = :id_com";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'likes2' => $newLikes,
                'id_com' => $ComId
            ]);
        } catch (Exception $e) {
            die('Erreur lors de la mise à jour des likes : ' . $e->getMessage());
        }

        // Rediriger vers la page du forum
        header("Location: showforum.php");
        exit();
    } else {
        echo "Erreur : Commentaire non trouvé.";
    }
} else {
    echo "Erreur : ID du commentaire manquant.";
}
?>
