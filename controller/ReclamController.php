<?php
require __DIR__.'/../config.php';
require_once __DIR__. '/../Model/Reclamation.php';

class ReclamController
{
    // Récupérer toutes les réclamations
    public function listReclamations()
    {
        $sql = "SELECT * FROM reclam";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch(Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter une réclamation
    public function addReclamation($reclam)
    {
        $sql = "INSERT INTO reclam (date_creation, objet, statut, nom_utilisateur)
                VALUES (:date_creation, :objet, :statut, :nom_utilisateur)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_creation' => $reclam->getDateCreation()->format('Y-m-d'),
                'objet' => $reclam->getObjet(),
                'statut' => $reclam->getStatut(),
                'nom_utilisateur' => $reclam->getNomUtilisateur()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getReclamationById($id_reclamation)
    {
        try {
            // Récupère la connexion à la base de données via la configuration
            $db = Config::getConnexion();
            
            // Prépare la requête SQL pour récupérer la réclamation par ID
            $query = $db->prepare("SELECT * FROM reclamation WHERE id_reclamation = :id_reclamation");
            
            // Exécute la requête en passant l'ID de la réclamation comme paramètre
            $query->execute(['id_reclamation' => $id_reclamation]);
            
            // Récupère les résultats de la requête et les retourne sous forme de tableau associatif
            return $query->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            // En cas d'erreur, affiche le message d'erreur
            echo "Erreur : " . $e->getMessage();
            return null;  // Retourne null en cas d'erreur
        }
    }
    


    // Modifier une réclamation
    public function updateReclamation($id_reclamation, $reclam)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                "UPDATE reclam SET date_creation = :date_creation, objet = :objet, statut = :statut, nom_utilisateur = :nom_utilisateur
                 WHERE id_reclamation = :id_reclamation"
            );
            $query->execute([
                'id_reclamation' => $id_reclamation,
                'date_creation' => $reclam->getDateCreation()->format('Y-m-d'),
                'objet' => $reclam->getObjet(),
                'statut' => $reclam->getStatut(),
                'nom_utilisateur' => $reclam->getNomUtilisateur()
            ]);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Supprimer une réclamation
public function deleteReclamation($id)
{
    $sql = "DELETE FROM reclamation WHERE id_reclamation = :id_reclamation";
    $db = Config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id_reclamation', $id);

    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}


public function listReclamationsWithReponse() {
    return $this->model->getReclamationsWithReponse();
}


public function processAddReponse() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_reclamation'], $_POST['contenu'])) {
        $reponseController = new ReponseController();
        if ($reponseController->addReponseToReclamation($_POST['id_reclamation'], $_POST['contenu'])) {
            header("Location: reclamationview.php");
            exit();
        }
    }
}
}


?>
