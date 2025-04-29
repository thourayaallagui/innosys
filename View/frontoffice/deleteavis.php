<?php
include __DIR__ . '/../../Controller/AvisController.php';


$avisController = new AvisController();


if (isset($_GET['id_avis']) && !empty($_GET['id_avis'])) {
    $id_avis = $_GET['id_avis'];

    
    $avisController->deleteAvis($id_avis);

    
    header("Location: blogshow.php");
    exit();
} else {
    
    echo "Erreur : ID de l'avis non fourni.";
    exit();
}
?>
