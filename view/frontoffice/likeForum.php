<?php
include __DIR__.'/../../Controller/Forumcontroller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forum_id'])) {
    $forumC = new Forumcontroller();
    $forumId = $_POST['forum_id'];

    // Récupérer les informations du forum
    $forum = $forumC->getForumById($forumId);
    if ($forum) {
        // Incrémenter le nombre de likes
        $newLikes = $forum['likes'] + 1;

        // Mettre à jour le nombre de likes dans la base de données
        $sql = "UPDATE forum_sujets SET likes = :likes WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'likes' => $newLikes,
                'id' => $forumId
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
        $titre = $forum['titre'];
        // Rediriger vers la page du forum avec un message de succès
        header("Location: showforum.php?liked=1&titre=" . urlencode($titre));
        exit();
    }
} else {
    echo "Erreur : Forum ID manquant.";
}
?>
