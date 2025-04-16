<?php
require_once('C:/xampp/htdocs/gevent/config.php');
include 'C:/xampp/htdocs/gevent/model/evenement.php';

class EvenementC
{
    public function create($event)
    {
        $sql = "INSERT INTO `evenement`(`nom`, `organisateur`, `description`, `type`, `date`, `place`)
                VALUES (:nom, :organisateur, :description, :type, :date, :place)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $event->getNom(),
                'organisateur' => $event->getOrganisateur(),
                'description' => $event->getDescription(),
                'type' => $event->getType(),
                'date' => $event->getDate(),
                'place' => $event->getPlace(),
            ]);
            header('Location:events.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM evenement";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function update($event, $id)
    {
        $sql = "UPDATE `evenement` SET `nom`=:nom, `organisateur`=:organisateur, `description`=:description,
                `type`=:type, `date`=:date, `place`=:place WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $event->getNom(),
                'organisateur' => $event->getOrganisateur(),
                'description' => $event->getDescription(),
                'type' => $event->getType(),
                'date' => $event->getDate(),
                'place' => $event->getPlace(),
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function delete()
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql = "DELETE FROM `evenement` WHERE `id` = '$id'";
            $db = config::getConnexion();
            try {
                $db->prepare($sql)->execute();
                header("Location:events.php");
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }
// Cette fonction permet de récupérer les détails d'un événement spécifique depuis la base de données
// en fonction de son ID, et retourne les résultats sous forme d'un tableau associatif.

    public function findone($id)
    {
        $sql = "SELECT * FROM evenement WHERE id = '$id'";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetch();//Afficher des données 
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
