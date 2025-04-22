<?php
require_once('config.php');

class SponsorC
{
    // Ajouter un sponsor
    public function addSponsor($sponsor)
    {
        $sql = "INSERT INTO sponsor (nom, mont, type, dateA, engag) 
                VALUES (:nom, :mont, :type, :dateA, :engag)";

        $db = config::getConnexion();

        try {
            // Préparation de la requête SQL
            $query = $db->prepare($sql);

            // Exécution de la requête avec les paramètres
            $query->execute([
                'nom' => $sponsor->getNom(),
                'mont' => $sponsor->getMont(),
                'type' => $sponsor->getType(),
                'dateA' => $sponsor->getDateA(),
                'engag' => $sponsor->getEngag(),
            ]);

            return "Sponsor ajouté avec succès!";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return "Erreur lors de l'ajout du sponsor.";
        } catch (Exception $e) {
            echo 'Erreur générale: ' . $e->getMessage();
            return "Erreur générale.";
        }
    }

    // Liste des sponsors
    public function listSponsors()
    {
        $sql = "SELECT * FROM sponsor";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Supprimer un sponsor
    public function deleteSponsor($id)
    {
        $sql = "DELETE FROM sponsor WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Afficher un sponsor
    public function showSponsor($id)
    {
        $sql = "SELECT * FROM sponsor WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $sponsor = $query->fetch();
            return $sponsor;
        } catch (Exception $e) {
            throw new Exception('Error showing sponsor: ' . $e->getMessage());
        }
    }

    // Mettre à jour un sponsor
    public function updateSponsor($sponsor, $id)
    {
        $sql = "UPDATE sponsor SET
                    nom = :nom,
                    mont = :mont,
                    type = :type,
                    dateA = :dateA,
                    engag = :engag
                WHERE id = :id";

        $db = config::getConnexion();
        $query = $db->prepare($sql);

        $query->bindValue(':nom', $sponsor->getNom());
        $query->bindValue(':mont', $sponsor->getMont());
        $query->bindValue(':type', $sponsor->getType());
        $query->bindValue(':dateA', $sponsor->getDateA());
        $query->bindValue(':engag', $sponsor->getEngag());
        $query->bindValue(':id', $id);

        return $query->execute();
    }
}
?>
