<?php

require __DIR__.'/../Modele/commentaire.php';
require_once __DIR__.'/../config.php';

class CommentaireController
{
    // Récupérer tous les commentaires
    public function listCommentaires()
    {
        $sql = "SELECT * FROM commentaire";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
   


    // Ajouter un commentaire
    public function addCommentaire($commentaire)
    {
        $sql = "INSERT INTO commentaire (contenu ) 
                VALUES (:contenu )";
        

        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contenu' => $commentaire->getContenu(),
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Afficher un commentaire spécifique
    public function showCommentaire($id_com)
    {
        $sql = "SELECT * FROM commentaire WHERE id_com = :id_com";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_com' => $id_com]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Obtenir un commentaire par son ID
    public function getCommentaireById($id_com)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("SELECT * FROM commentaire WHERE id_com = :id_com");
            $query->execute(['id_com' => $id_com]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    // Modifier un commentaire
    public function updateCommentaire($id_com, $commentaire)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE commentaire 
                 SET contenu = :contenu, date_creation = :date_creation, id = :id 
                 WHERE id_com = :id_com'
            );
            $query->execute([
                'id_com' => $id_com,
                'contenu' => $commentaire->getContenu(),
                'date_creation' => $commentaire->getDateCreation()->format('Y-m-d H:i:s'),
                'id' => $commentaire->getId()
            ]);
            echo $query->rowCount() . " enregistrement(s) mis à jour avec succès.<br>";
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Supprimer un commentaire
    public function deleteCommentaire($id_com)
    {
        $sql = "DELETE FROM commentaire WHERE id_com = :id_com";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_com', $id_com);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
