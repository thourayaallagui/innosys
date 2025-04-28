<?php
require_once __DIR__.'/../config.php';
require __DIR__.'/../Modele/reponse.php';

class ReponseController
{
    // Récupérer toutes les réponses
    public function listReponses()
    {
        $sql = "SELECT * FROM reponse";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter une réponse
    public function addReponse($reponse)
    {
        $sql = "INSERT INTO reponse (contenu, id_com) 
                VALUES (:contenu, :id_com)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contenu' => $reponse->getContenu(),
               
                'id_com' => $reponse->getIdCom()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Afficher une réponse spécifique
    public function showReponse($id_rep)
    {
        $sql = "SELECT * FROM reponse WHERE id_rep = :id_rep";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_rep' => $id_rep]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Obtenir une réponse par son ID
    public function getReponseById($id_rep)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("SELECT * FROM reponse WHERE id_rep = :id_rep");
            $query->execute(['id_rep' => $id_rep]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    // Modifier une réponse
    public function updateReponse($id_rep, $reponse)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE reponse SET contenu = :contenu, date_creation = :date_creation, id_com = :id_com 
                 WHERE id_rep = :id_rep'
            );
            $query->execute([
                'id_rep' => $id_rep,
                'contenu' => $reponse->getContenu(),
                'date_creation' => $reponse->getDateCreation()->format('Y-m-d H:i:s'),
                'id_com' => $reponse->getIdCom()
            ]);
            echo $query->rowCount() . " enregistrement(s) mis à jour avec succès.<br>";
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Supprimer une réponse
    public function deleteReponse($id_rep)
    {
        $sql = "DELETE FROM reponse WHERE id_rep = :id_rep";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_rep', $id_rep);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
