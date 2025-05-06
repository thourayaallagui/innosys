<?php
require_once('C:/xampp/htdocs/greclamation/config.php');
include 'C:/xampp/htdocs/greclamation/model/Reclamation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class ReclamationC
{

    public function create($reclamation)
    {
        $sql = "INSERT INTO `reclamation`(`date_creation`, `objet`, `statut`, `user_id`)
                VALUES (:date_creation, :objet, :statut, :user_id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_creation' => $reclamation->getDateCreation(),
                'objet' => $reclamation->getObjet(),
                'statut' => $reclamation->getStatut(),
                'user_id' => $reclamation->getUserId(),
            ]);
            header('Location:reclamations.php');
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT r.*, rp.message AS reponse_message
                FROM reclamation r
                LEFT JOIN (
                    SELECT id_reclamation, message
                    FROM reponse
                    ORDER BY date_reponse DESC
                ) rp ON r.id_reclamation = rp.id_reclamation";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function update($reclamation, $id)
    {
        $sql = "UPDATE `reclamation` SET `date_creation`=:date_creation, `objet`=:objet, 
                `statut`=:statut, `user_id`=:user_id WHERE `id_reclamation`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_creation' => $reclamation->getDateCreation(),
                'objet' => $reclamation->getObjet(),
                'statut' => $reclamation->getStatut(),
                'user_id' => $reclamation->getUserId(),
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
            $sql = "DELETE FROM `reclamation` WHERE `id_reclamation` = '$id'";
            $db = config::getConnexion();
            try {
                $db->prepare($sql)->execute();
                header("Location:index.php");
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }
    
    

    public function updateStatut($id, $statut)
    {
        $conn = config::getConnexion();
    
        
        $sql = "UPDATE reclamation SET statut = :statut WHERE id_reclamation = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        if ($result && strtolower($statut) === 'résolue') {
    
            $query = "SELECT u.email FROM users u
                      JOIN reclamation r ON u.id = r.user_id
                      WHERE r.id_reclamation = :id";
            $stmtUser = $conn->prepare($query);
            $stmtUser->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtUser->execute();
            $email = $stmtUser->fetchColumn();
            if ($email) {
                
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'thourayallagui@gmail.com'; // Ton email 
                    $mail->Password = 'yrvq duzl vvgh ssju';   // Mot de passe d'application
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->SMTPOptions = [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        ]
                    ];
                    $mail->setFrom('thourayallagui@gmail.com', 'Votre plateforme');
                    $mail->addAddress($email);
    
                    $mail->isHTML(true);
                    $mail->Subject = 'Reclamation resolue';
                    $mail->Body = "
                        Bonjour,<br><br>
                        Votre réclamation  a été marquée comme <b>Résolue</b>.<br><br>
                        Merci de nous avoir contactés.<br><br>
                        Cordialement,<br>L'équipe Votre plateforme.";
                        $mail->send();
                    
                } catch (Exception $e) {
                    error_log("Erreur d'envoi du mail : " . $mail->ErrorInfo);
                }
            }
        }
    
        return $result;
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM reclamation WHERE id_reclamation = '$id'";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetch();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }



    public function findByStatut($statut)
{
    $sql = "SELECT r.*, rp.message AS reponse_message
            FROM reclamation r
            LEFT JOIN (
                SELECT id_reclamation, message
                FROM reponse
                ORDER BY date_reponse DESC
            ) rp ON r.id_reclamation = rp.id_reclamation
            WHERE r.statut = :statut";
    $db = config::getConnexion();
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die('Erreur:' . $e->getMessage());
    }
}



public function readSortedByDate($order = 'ASC')
{
    $sql = "SELECT r.*, rp.message AS reponse_message
            FROM reclamation r
            LEFT JOIN (
                SELECT id_reclamation, message
                FROM reponse
                ORDER BY date_reponse DESC
            ) rp ON r.id_reclamation = rp.id_reclamation
            ORDER BY r.date_creation $order"; // tri dynamique

    $db = config::getConnexion();
    try {
        return $db->query($sql);
    } catch (Exception $e) {
        die('Erreur:' . $e->getMessage());
    }
}


public function getStatistiquesParStatut()
{
    $sql = "SELECT statut, COUNT(*) AS total FROM reclamation GROUP BY statut";
    $db = config::getConnexion();
    try {
        $result = $db->query($sql);
        return $result->fetchAll();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


}





    

