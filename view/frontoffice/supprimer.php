<?php
include __DIR__ . '/../../Controller/ReclamController.php';

// Crée une instance du contrôleur
$reclamationC = new ReclamController();

// Vérifie si 'id_reclamation' est fourni dans l'URL
if (isset($_GET['id_reclamation']) && !empty($_GET['id_reclamation'])) {
    $id_reclamation = $_GET['id_reclamation'];

    // Appelle la méthode pour supprimer la réclamation
    $reclamationC->deleteReclamation($id_reclamation);

    // Redirige vers la page d'affichage après suppression
    header("Location: reclamationview.php");
    exit();
} else {
    // Affiche un message d'erreur si l'ID est manquant
    echo "Erreur : ID de la réclamation non fourni.";
    exit();
}
?>
