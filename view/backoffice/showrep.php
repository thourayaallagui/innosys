<?php
require_once __DIR__ . '/../../Controller/ReponseController.php';

$reponseC = new ReponseController();
$idCommentaire = $_GET['id_com'] ?? null;
$reponsesAssociees = [];

if ($idCommentaire) {
    $idCommentaire = intval($idCommentaire);
    $toutesReponses = $reponseC->listReponses(); // récupère toutes les réponses

    // Ne garder que celles liées au bon commentaire
    $reponsesAssociees = array_filter($toutesReponses, function ($reponse) use ($idCommentaire) {
        return isset($reponse['id_com']) && $reponse['id_com'] == $idCommentaire;
    });
}
?>

<link rel="stylesheet" href="css/style.css" />
<div class="comment-section">
    <h3 class="subtitle">💬 Réponses associées</h3>

    <?php if (!empty($reponsesAssociees)) : ?>
        <?php foreach ($reponsesAssociees as $reponse) : ?>
            <div class="commentaire-card">
                <p><?= htmlspecialchars($reponse['contenu']) ?></p>
                <small>Posté le <?= date('d/m/Y H:i', strtotime($reponse['date_creation'])) ?></small>
                
            </div>
        <?php endforeach; ?>
        <?php else : ?>
        <p>Aucun reponse pour ce sujet.</p>
    <?php endif; ?>
   
</div>
