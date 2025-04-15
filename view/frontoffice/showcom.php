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

<div class="comment-section">
    <h3 class="subtitle">💬 Commentaires du sujet</h3>

    <?php if (!empty($commentairesSujet)) : ?>
        <?php foreach ($commentairesSujet as $commentaire) : ?>
            <div class="commentaire-card">
                <p><?= htmlspecialchars($commentaire['contenu']) ?></p>
                <small>Posté le <?= date('d/m/Y H:i', strtotime($commentaire['date_creation'])) ?></small>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucun commentaire pour ce sujet.</p>
    <?php endif; ?>

    <!-- Formulaire de commentaire -->
    <form method="POST" action="addcomm.php" class="comment-form">
        <input type="hidden" name="id" value="<?= htmlspecialchars($forumId) ?>">
        <textarea name="contenu" placeholder="Ajouter un commentaire..." required></textarea>
        <button type="submit" class="btn btn-green">Commentateur</button>
    </form>
</div>
