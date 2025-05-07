<?php
require_once('C:/xampp/htdocs/gresclamation/config.php');
include 'C:/xampp/htdocs/gresclamation/model/Reclamation.php';


$db = config::getConnexion();
$sql = "SELECT COUNT(*) as total FROM reclamation WHERE statut = 'en attente'";
$stmt = $db->query($sql);
$row = $stmt->fetch();

if ($row['total'] > 0) {
    $message = "Vous avez {$row['total']} réclamation(s) en attente.";

    // Crée un script PowerShell temporaire
    $psScript = "Import-Module BurntToast; New-BurntToastNotification -Text 'Notification Réclamation', '$message'";

    $tempFile = tempnam(sys_get_temp_dir(), 'notif_') . '.ps1';
    file_put_contents($tempFile, $psScript);

    // Exécute le script PowerShell
    shell_exec("powershell -ExecutionPolicy Bypass -File \"$tempFile\"");

    // Optionnel : supprimer le fichier temporaire après exécution
    // unlink($tempFile);

    error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . "/error_log.txt");

echo "Le script se lance bien\n";
file_put_contents("log.txt", date('Y-m-d H:i:s') . " - Script lancé\n", FILE_APPEND);


}
