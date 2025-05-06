<?php
require_once __DIR__ . '/../../Controller/ReponseController.php';
require_once __DIR__ . '/../../Controller/CommentaireController.php';
require_once __DIR__ . '/iautils.php';

// Instanciation des contrôleurs
$reponseC = new ReponseController();
$commentaireC = new CommentaireController();

$forumId = $_GET['id_com'] ?? null;
$reponseSujet = [];
$commentaire = null;
$suggestions = [];

if ($forumId) {
    $forumId = intval($forumId);

    // Récupérer le commentaire lié
    $commentaire = $commentaireC->getCommentaireById($forumId);

    // Récupérer toutes les réponses
    $toutesReponses = $reponseC->listReponses();

    // Filtrer les réponses associées au commentaire
    $reponseSujet = array_filter($toutesReponses, function ($r) use ($forumId) {
        return isset($r['id_com']) && $r['id_com'] == $forumId;
    });

    // Générer des suggestions à partir du contenu du commentaire (et non des réponses)
    if (!empty($commentaire) && isset($commentaire['contenu'])) {
        $suggestionTexte = suggestReplies($commentaire['contenu']);
        $suggestions = explode("\n", $suggestionTexte);
    }
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
                    <a href="deletereponse.php?id_rep=<?= htmlspecialchars($reponse['id_rep']) ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?');">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucune réponse pour ce sujet.</p>
    <?php endif; ?>

    <?php if (!empty($suggestions)) : ?>
        <div class="suggestions">
            <p><strong>💡 Suggestions de réponse :</strong></p>
            <?php foreach ($suggestions as $s): ?>
                <button type="button" class="suggestion-btn" onclick='insertSuggestion(<?= json_encode($s) ?>, <?= json_encode("contenu-$forumId") ?>)'>
                    <?= htmlspecialchars($s) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire d'ajout de réponse -->
    <form method="POST" action="addreponse.php" class="comment-form">
        <input type="hidden" name="id_com" value="<?= htmlspecialchars($forumId) ?>">
        <textarea name="contenu" id="contenu-<?= htmlspecialchars($forumId) ?>" placeholder="Ajouter une réponse..." required></textarea>
        <button type="submit" class="btn btn-green">Répondre</button>
    </form>
</div>

<script>
function insertSuggestion(text, textareaId) {
    const textarea = document.getElementById(textareaId);
    if (textarea) {
        if (textarea.value.trim() !== '') {
            textarea.value += '\n' + text;
        } else {
            textarea.value = text;
        }
        textarea.focus();
    } else {
        alert('Impossible de trouver le champ de réponse pour cette suggestion.');
    }
}
</script>
