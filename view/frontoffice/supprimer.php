<?php
// Inclure le contrôleur de réclamation
include __DIR__ . '/../../Controller/ReclamController.php';

// Créer une instance du contrôleur
$reclamController = new ReclamController();

// Vérifier si l'ID de la réclamation est fourni dans l'URL
if (isset($_GET['id_reclamation']) && !empty($_GET['id_reclamation'])) {
    $id_reclamation = $_GET['id_reclamation'];

    // Appeler la fonction deleteReclamation pour supprimer la réclamation
    $reclamController->deleteReclamation($id_reclamation);

    // Rediriger vers la liste des réclamations après suppression
    header("Location: listReclamations.php");
    exit();
} else {
    // Si aucun ID n’est fourni
    echo "Erreur : ID de la réclamation non fourni.";
    exit();
}
?>
