<?php
session_start();
include('../../controller/userC.php');

$userC = new userC();

if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);
    $users = $userC->search($query); // Assurez-vous que cette méthode est définie dans votre classe userC
    echo json_encode($users);
}
?>