<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Model/Avis.php';

class AvisController
{
    
    public function listAvis()
    {
        $sql = "SELECT * FROM avis";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    
    public static function calculerMoyenneParBlog($id_blog) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("SELECT AVG(note) as moyenne FROM avis WHERE id_blog = :id_blog");
            $query->bindParam(':id_blog', $id_blog, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['moyenne'] : null;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return null;
        }
    }
    


    
    public function addAvis($avis)
    {
        $sql = "INSERT INTO avis (note, commentaire, date_avis, id_blog) 
                VALUES (:note, :commentaire, :date_avis, :id_blog)";
    
        $db = Config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'note' => $avis->getNote(),
                'commentaire' => $avis->getCommentaire(),
                'date_avis' => $avis->getDateAvis()->format('Y-m-d'),
                'id_blog' => $avis->getIdBlog()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    
    public function showAvis($id)
    {
        $sql = "SELECT * FROM avis WHERE id_avis = :id_avis";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_avis' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getAvisById($id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("SELECT * FROM avis WHERE id_avis = :id_avis");
            $query->execute(['id_avis' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }


    
public function getAvisByBlogId($id_blog)
{
    try {
        $db = Config::getConnexion();
        $query = $db->prepare("SELECT * FROM avis WHERE id_blog = :id_blog ORDER BY date_avis DESC");
        $query->execute(['id_blog' => $id_blog]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}


    
    public function updateAvis($id, $avis)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE avis 
                 SET note = :note, commentaire = :commentaire, date_avis = :date_avis 
                 WHERE id_avis = :id_avis'
            );
            $query->execute([
                'id_avis' => $id,
                'note' => $avis->getNote(),
                'commentaire' => $avis->getCommentaire(),
                'date_avis' => $avis->getDateAvis()->format('Y-m-d')
            ]);
            echo $query->rowCount() . " avis modifié(s) avec succès.<br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function deleteAvis($id)
    {
        $sql = "DELETE FROM avis WHERE id_avis = :id_avis";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_avis', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
