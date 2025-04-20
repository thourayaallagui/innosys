<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../Model/Blog.php';

class BlogController
{
    // Récupérer tous les blogs
    public function listBlogs()
    {
        $sql = "SELECT * FROM blog";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter un blog
    public function addBlog($blog)
    {
        $sql = "INSERT INTO blog (titre, contenu, nb_vues, nb_likes, date_publication, categorie) 
                VALUES (:titre, :contenu, :nb_vues, :nb_likes, :date_publication, :categorie)";

        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $blog->getTitre(),
                'contenu' => $blog->getContenu(),
                'nb_vues' => $blog->getNbVues(),
                'nb_likes' => $blog->getNbLikes(),
                'date_publication' => $blog->getDatePublication()->format('Y-m-d'),
                'categorie' => $blog->getCategorie()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Afficher un blog spécifique
    public function showBlog($id)
    {
        $sql = "SELECT * FROM blog WHERE id_blog = :id_blog";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_blog' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getBlogById($id)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare("SELECT * FROM blog WHERE id_blog = :id_blog");
            $query->execute(['id_blog' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    // Mettre à jour un blog
    public function updateBlog($id, $blog)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE blog 
                 SET titre = :titre, contenu = :contenu, nb_vues = :nb_vues, 
                     nb_likes = :nb_likes, date_publication = :date_publication, categorie = :categorie 
                 WHERE id_blog = :id_blog'
            );
            $query->execute([
                'id_blog' => $id,
                'titre' => $blog->getTitre(),
                'contenu' => $blog->getContenu(),
                'nb_vues' => $blog->getNbVues(),
                'nb_likes' => $blog->getNbLikes(),
                'date_publication' => $blog->getDatePublication()->format('Y-m-d'),
                'categorie' => $blog->getCategorie()
            ]);
            echo $query->rowCount() . " blog(s) modifié(s) avec succès.<br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Supprimer un blog
    public function deleteBlog($id)
    {
        $sql = "DELETE FROM blog WHERE id_blog = :id_blog";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_blog', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
