<?php

 require_once('C:\xampp\htdocs\Click&Go\controller\sponsorC.php');
 $sponsorC= new sponsorC();
$sponsorC->deleteSponsor($_GET['id'] );
header('Location: liste.php');
?>