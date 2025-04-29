<?php
require_once('C:/xampp/htdocs/greclamation/config.php');
include 'C:/xampp/htdocs/greclamation/model/Reponse.php';

class ReponseC
{
    public function create($reponse)
    {
        $sql = "INSERT INTO `reponse` (`date_reponse`, `message`, `id_reclamation`)
            VALUES (:date_reponse, :message, :id_reclamation)
            ON DUPLICATE KEY UPDATE
            date_reponse = VALUES(date_reponse),
            message = VALUES(message)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_reponse' => $reponse->getDateReponse(),
                'message' => $reponse->getMessage(),
                'id_reclamation' => $reponse->getIdReclamation(),
            ]);
            header('Location:reclamtions.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM reponse";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function update($reponse, $id)
    {
        $sql = "UPDATE `reponse` SET `date_reponse`=:date_reponse, `message`=:message, 
                `id_reclamation`=:id_reclamation WHERE `id_reponse`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_reponse' => $reponse->getDateReponse(),
                'message' => $reponse->getMessage(),
                'id_reclamation' => $reponse->getIdReclamation(),
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
            $sql = "DELETE FROM `reponse` WHERE `id_reclamation` = '$id'";
            $db = config::getConnexion();
            try {
                $db->prepare($sql)->execute();
                header("Location:reclamtions.php");
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM reponse WHERE id_reponse = '$id'";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetch();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
