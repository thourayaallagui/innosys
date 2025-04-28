<?php
require_once __DIR__ . '/../../Controller/CommentaireController.php';

$commentaireC = new CommentaireController();
$forumId = $_GET['id'] ?? null;
$commentairesSujet = [];

if ($forumId) {
    $forumId = intval($forumId);
    $commentaires = $commentaireC->listCommentaires(); // récupère tous les commentaires

    // Ne garder que ceux du bon sujet
    $commentairesSujet = array_filter($commentaires, function ($c) use ($forumId) {
        return isset($c['id']) && $c['id'] == $forumId;
    });
}
?>
<link rel="stylesheet" href="css/style.css" />
<div class="comment-section">
    <h3 class="subtitle">💬 Commentaires du sujet</h3>

    <?php if (!empty($commentairesSujet)) : ?>
        <?php foreach ($commentairesSujet as $commentaire) : ?>
            <div class="commentaire-card">
                <p><?= htmlspecialchars($commentaire['contenu']) ?></p>
                <small>Posté le <?= date('d/m/Y H:i', strtotime($commentaire['date_creation'])) ?></small>
                <div class="forum-buttons">
                    <a href="updatecom.php?id_com=<?= htmlspecialchars($commentaire['id_com']) ?>" class="edit">Modifier</a>
                    <a href="deletecom.php?id_com=<?= htmlspecialchars($commentaire['id_com']) ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</a>
                    <button type="button" class="btn btn-green" onclick="toggleCommentaire('commentaire-<?= $commentaire['id_com'] ?>')">Réponses</button>
                </div>

                <!-- Bloc de réponses lié à ce commentaire -->
                <div class="commentaire-wrapper" id="commentaire-<?= $commentaire['id_com'] ?>" style="display: none;">
                    <?php
                    $_GET['id_com'] = $commentaire['id_com']; // ou $commentaire['id_com'] si les réponses sont liées au commentaire
                    include 'showreponse.php';
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun commentaire pour ce sujet.</p>
    <?php endif; ?>

    <!-- Formulaire d'ajout de commentaire -->
    <form method="POST" action="addcomm.php" class="comment-form">
        <input type="hidden" name="id" value="<?= htmlspecialchars($forumId) ?>">
        <textarea name="contenu" id="commentaireContenu" placeholder="Ajouter un commentaire..." required></textarea>
        <div id="msg-commentaire" class="error-message"></div>
        <button type="submit" class="btn btn-green">Commenter</button>
    </form>
</div>

<!-- JS pour afficher/masquer les réponses -->
<script>
function toggleCommentaire(id) {
    const element = document.getElementById(id);
    if (element) {
        element.style.display = (element.style.display === "none") ? "block" : "none";
    }
}
</script>
