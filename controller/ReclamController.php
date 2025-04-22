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

    // Afficher une réclamation spécifique
    public function showReclamation($id_reclamation)
    {
        $sql = "SELECT * FROM reclam WHERE id_reclamation = :id_reclamation";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_reclamation' => $id_reclamation]);
            return $query->fetch();
        } catch(Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

   public function getReclamationById($id_reclamation)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("SELECT * FROM reclam WHERE id_reclamation = :id_reclamation");
            $query->execute(['id_reclamation' => $id_reclamation]);
            return $query->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
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
    public function deleteReclamation($id_reclamation)
    {
        $sql = "DELETE FROM reclam WHERE id_reclamation = :id_reclamation";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_reclamation', $id_reclamation);

        try {
            $req->execute();
        } catch(Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}






 function editReclamation($id) {
    $reclamation = $this->getReclamationById($id);
    return $reclamation;
}

 function processUpdate() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
        $id = $_POST['update_id'];
        $date_creation = $_POST['date_creation'];
        $objet = $_POST['objet'];
        $statut = $_POST['statut'];
        $nom_utilisateur = $_POST['nom_utilisateur'];
        
        if ($this->updateReclamation($id, $date_creation, $objet, $statut, $nom_utilisateur)) {
            header("Location: reclamationview.php");
            exit();
        }
    }
}

?>
