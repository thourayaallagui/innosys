<?php
function suggestReplies($message) {
    $message = strtolower($message); // Mise en minuscule
    $suggestions = [];

    // Catégories thématiques
    if (strpos($message, 'cinéma') !== false || strpos($message, 'film') !== false) {
        $suggestions = [
            "C'était quel film ?",
            "J’aimerais trop vivre ça aussi !",
            "Le cadre devait être génial !"
        ];
    } elseif (strpos($message, 'concert') !== false || strpos($message, 'musique') !== false) {
        $suggestions = [
            "Quel artiste jouait ?",
            "Ça devait être inoubliable !",
            "J’adore les concerts en plein air !"
        ];
    } elseif (strpos($message, 'fête') !== false || strpos($message, 'festival') !== false) {
        $suggestions = [
            "Tu y vas chaque année ?",
            "L’ambiance était comment ?",
            "C’est quel type de musique ?"
        ];
    } elseif (strpos($message, 'exposition') !== false || strpos($message, 'musée') !== false || strpos($message, 'art') !== false) {
        $suggestions = [
            "C'était une expo temporaire ?",
            "Tu as eu un coup de cœur ?",
            "J’adore ce genre d’événements !"
        ];
    } elseif (strpos($message, 'match') !== false || strpos($message, 'sport') !== false) {
        $suggestions = [
            "Ton équipe a gagné ?",
            "Quelle ambiance dans le stade !",
            "Tu pratiques ce sport toi aussi ?"
        ];
    }

    // Mots positifs – suggestions supplémentaires (peuvent s’ajouter à d'autres)
    if (
        strpos($message, 'aime') !== false ||
        strpos($message, 'ador') !== false ||
        strpos($message, 'bonne') !== false ||
        strpos($message, 'magique') !== false ||
        strpos($message, 'formidable') !== false ||
        strpos($message, 'incroyable') !== false ||
        strpos($message, 'super') !== false ||
        strpos($message, 'top') !== false
    ) {
        $suggestions = array_merge($suggestions, [
            "Tu sembles avoir passé un très bon moment.",
            "C’est beau de te lire comme ça !",
            "Merci pour cet enthousiasme communicatif !",
            "Tu me donnes envie de tenter l’expérience aussi.",
            "C’est ce genre de moment qui rend la vie belle.",
     
            "On voit que ça t’a marqué positivement !",
            "Tu pourrais en parler davantage ? Ça a l’air génial.",
            "Trop bien ! Tu as l’air vraiment heureux(se)."
        ]);
    }

    // Si aucune suggestion trouvée
    if (empty($suggestions)) {
        $suggestions = [
            "Merci pour le partage !",
            "Tu peux en dire plus ?",
            "Ça donne envie d’y aller aussi !"
        ];
    }

    return implode("\n", $suggestions);
}
?>
