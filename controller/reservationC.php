<?php
require_once('C:/xampp/htdocs/gevent/config.php');
include 'C:/xampp/htdocs/gevent/model/reservation.php';

class ReservationC
{
    // Create Reservation
    public function create($res)
{
    $sql = "INSERT INTO `reservation`(`nomClient`, `emailClient`, `telClient`, `dateReservation`, `event_id`)
            VALUES (:nomClient, :emailClient, :telClient, :dateReservation, :event_id)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nomClient' => $res->getNomClient(),
            'emailClient' => $res->getEmailClient(),
            'telClient' => $res->getTelClient(),
            'dateReservation' => $res->getDateReservation(),
            'event_id' => $res->getEventId(),
        ]);

        $to_email = $res->getEmailClient();
        $subject = "Confirmation de réservation";
        
        $body = "
        <html>
        <head>
            <style>
                .email-container {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    background-color: #f5f5f5;
                    border-radius: 10px;
                    color: #333;
                }
                .email-header {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px;
                    border-radius: 10px 10px 0 0;
                    text-align: center;
                }
                .email-content {
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 0 0 10px 10px;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <h2>Confirmation de réservation</h2>
                </div>
                <div class='email-content'>
                    <p>Bonjour <strong>" . htmlspecialchars($res->getNomClient()) . "</strong>,</p>
                    <p>Merci pour votre réservation. Nous vous confirmons que votre demande a bien été enregistrée.</p>
                    <p>Date de réservation : <strong>" . htmlspecialchars($res->getDateReservation()) . "</strong></p>
                    <p>Nous vous remercions de votre confiance.</p>
                </div>
                <div class='footer'>
                    &copy; " . date('Y') . " Votre société - Tous droits réservés.
                </div>
            </div>
        </body>
        </html>";

        $headers = "From: karouihajer5@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";

        mail($to_email, $subject, $body, $headers);
        echo "<script>alert('Réservation enregistrée !');</script>";
    } catch (Exception $e) {
        echo 'Erreur: ' . $e->getMessage();
    }
}


    // Read all reservations
    public function read()
    {
        $sql = "SELECT * FROM reservation";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    // Update Reservation
    public function update($res, $id)
    {
        $sql = "UPDATE `reservation` SET `nomClient`=:nomClient, `emailClient`=:emailClient,
                `telClient`=:telClient, `dateReservation`=:dateReservation, `event_id`=:event_id WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomClient' => $res->getNomClient(),
                'emailClient' => $res->getEmailClient(),
                'telClient' => $res->getTelClient(),
                'dateReservation' => $res->getDateReservation(),
                'event_id' => $res->getEventId(), // Update event_id
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Delete Reservation
    public function delete()
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql = "DELETE FROM `reservation` WHERE `id` = '$id'";
            $db = config::getConnexion();
            try {
                $db->prepare($sql)->execute();
                header("Location:reservations.php");
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }

    // Find one Reservation by ID
    public function findone($id)
    {
        $sql = "SELECT * FROM reservation WHERE id = '$id'";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetch();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
