<?php
include __DIR__.'/../../Controller/ReponseController.php';
$error = '';
$forum = null;
$reponseC = new ReponseController();

if (isset($_POST['contenu']) && isset($_POST['id_com'])) {
    $forumId = intval($_POST['id_com']);

    
    $reponse = new Reponse(
        $_POST['contenu'],     
        new DateTime(),       
        $forumId                 
    );

    $reponseC->addReponse($reponse);

    header("Location: showforum.php");
    exit();
} else {
    echo "Veuillez remplir tous les champs.";
}
?>
