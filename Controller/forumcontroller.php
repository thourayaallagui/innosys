<?php
require __DIR__.'/../config.php';
require __DIR__.'/../Modele/forum.php';

class ForumController
{
    // Récupérer tous les forums
    public function listForums()
    {
        $sql = "SELECT * FROM forum_sujets";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter un forum
 // Ajouter un forum
public function addForum($forum)
{
    $sql = "INSERT INTO forum_sujets (titre, contenu) 
            VALUES (:titre, :contenu)";
    $db = Config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'titre' => $forum->getTitre(),
            'contenu' => $forum->getContenu()
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    // Afficher un forum spécifique
    public function showForum($id)
    {
        $sql = "SELECT * FROM forum_sujets WHERE id = :id";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Obtenir un forum par son ID (version alternative)
    public function getForumById($id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("SELECT * FROM forum_sujets WHERE id = :id");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    // Modifier un forum
    public function updateForum($id, $forum)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE forum_sujets SET titre = :titre, contenu = :contenu, date_creation = :date_creation 
                 WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'titre' => $forum->getTitre(),
                'contenu' => $forum->getContenu(),
                'date_creation' => $forum->getDateCreation()->format('Y-m-d H:i:s')
            ]);
            echo $query->rowCount() . " enregistrement(s) mis à jour avec succès.<br>";
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Supprimer un forum
    public function deleteForum($id)
    {
        $sql = "DELETE FROM forum_sujets WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>