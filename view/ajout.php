<?php

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure les fichiers nécessaires
    require_once('C:\xampp\htdocs\Click&Go\controller\sponsorC.php');
    require_once('C:\xampp\htdocs\Click&Go\model\sponsor.php');

    $sponsorC = new SponsorC();

    // Vérifier que tous les champs requis sont définis et non vides
    if (
        isset($_POST["nom"], $_POST["mont"], $_POST["type"], $_POST["dateA"], $_POST["engag"]) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["mont"]) &&
        !empty($_POST["type"]) &&
        !empty($_POST["dateA"]) &&
        !empty($_POST["engag"])
    ) {
        // Création de l'objet sponsor avec les données du formulaire
        $sponsor = new Sponsor(
            null,   // id non passé car auto-incrémenté
            $_POST['nom'],
            $_POST['mont'],
            $_POST['type'],
            $_POST['dateA'],
            $_POST['engag']
        );

        // Ajouter l'objet sponsor à la base de données via le contrôleur
        $sponsorC->addSponsor($sponsor);

        ?>
        <script>
            window.location.href = 'liste.php'; // Rediriger vers la liste des sponsors
        </script>
        <?php
        echo "Sponsor ajouté avec succès.";
    } else {
        // Si les champs sont invalides ou manquants
        echo "<br><strong>Erreur : Un ou plusieurs champs sont vides.</strong><br>";
        if (empty($_POST["nom"])) echo "Champ nom est vide.<br>";
        if (empty($_POST["mont"])) echo "Champ montant est vide.<br>";
        if (empty($_POST["type"])) echo "Champ type est vide.<br>";
        if (empty($_POST["dateA"])) echo "Champ date est vide.<br>";
        if (empty($_POST["engag"])) echo "Champ engagement est vide.<br>";

        ?>
        <script>
            // Rediriger vers la page de formulaire pour que l'utilisateur corrige
            window.location.href = 'front-office/sponsors.html'; // Rediriger vers la page de formulaire
        </script>
        <?php
    }
} else {
    // Si la requête n'est pas de type POST
    ?>
    <script>
        alert("Accès non autorisé !");
    </script>
    <?php
}
?>
