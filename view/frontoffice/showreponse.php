<?php
require_once __DIR__ . '/../../Controller/ReponseController.php';

$reponseC = new ReponseController();
$forumId = $_GET['id_com'] ?? null;
$reponseSujet = [];

if ($forumId) {
    $forumId = intval($forumId);
    $toutesReponses = $reponseC->listReponses(); // récupère toutes les réponses

    // Ne garder que celles du bon commentaire
    $reponseSujet = array_filter($toutesReponses, function ($r) use ($forumId) {
        return isset($r['id_com']) && $r['id_com'] == $forumId;
    });
}
?>
<link rel="stylesheet" href="css/style.css" />
<div class="comment-section">
    <h3 class="subtitle">💬 Réponses associées</h3>

    <?php if (!empty($reponseSujet)) : ?>
        <?php foreach ($reponseSujet as $reponse) : ?>
            <div class="commentaire-card">
                <p><?= htmlspecialchars($reponse['contenu']) ?></p>
                <small>Posté le <?= date('d/m/Y H:i', strtotime($reponse['date_creation'])) ?></small>
                <div class="forum-buttons">
                <a href="updatereponse.php?id_rep=<?= htmlspecialchars($reponse['id_rep']) ?>" class="edit">Modifier</a>
                    <a href="deletereponse.php?id_rep=<?= htmlspecialchars($reponse['id_rep']) ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce reponse ?');">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucune réponse pour ce sujet.</p>
    <?php endif; ?>

    <!-- Formulaire d'ajout de réponse -->
    <form method="POST" action="addreponse.php" class="comment-form">
        <input type="hidden" name="id_com" value="<?= htmlspecialchars($forumId) ?>">
        <textarea name="contenu" id="reponseContenu" placeholder="Ajouter une réponse..." required></textarea>
        <button type="submit" class="btn btn-green">Répondre</button>
    </form>
</div>
