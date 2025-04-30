<?php
require_once('../config.php');
require_once('../model/user.php');
require_once('userC.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $userC = new userC();
    $userC->login($_POST['email'], $_POST['password']);
} else {
    echo "Champs manquants.";
}
