<?php
include __DIR__ . '/../../Controller/AvisController.php';

// Créer une instance du contrôleur
$avisController = new AvisController();

// Vérifier si l'ID est fourni dans l'URL
if (isset($_GET['id_avis']) && !empty($_GET['id_avis'])) {
    $id_avis = $_GET['id_avis'];

    // Appeler la fonction deleteAvis pour supprimer l'avis
    $avisController->deleteAvis($id_avis);

    // Rediriger vers la liste des avis après suppression
    header("Location: liste_avis.php");
    exit();
} else {
    // Si aucun ID n’est fourni
    echo "Erreur : ID de l'avis non fourni.";
    exit();
}
?>
