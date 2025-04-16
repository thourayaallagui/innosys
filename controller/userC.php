<?php
require_once('C:/xampp/htdocs/guser/config.php');
include 'C:/xampp/htdocs/guser/model/user.php';
class userC
{

    public function create($user)
    {
 
        $sql = "INSERT INTO `users`(`nom`, `prenom`, `email`, `password`, `age`, `type`) VALUES (:nom,:prenom, :email, :password , :age , :type)";
        $db = config::getConnexion();  // N3ayet lel connexion mta3 base de données
        try {
            $query = $db->prepare($sql);// Na3mel préparation mta3 requête
            $query->execute([   // Na3mel execution mta3 requête b les données mta3 $user
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'age' => $user->getAge(),
                'type' => $user->getType(),
            ]);
            header('Location:users.php');// Nemchiw l page users.php l'orsque l'insertion tetmam
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();// Ken fam mochkla, naffichiw erreur

        }
    }


    public function read()
    {
        $sql = "SELECT * FROM users";//pour sélectionner tous les utilisateurs
        $db = config::getConnexion(); // N3ayet lel connexion
        try {
            $liste = $db->query($sql);// Na3mel execution direct mta3 requête
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());// Ken fam erreur, na3rfou l'erreur w ne9fou script
        }
    }


    public function reade()
    {
        $sql = "SELECT * FROM users WHERE type='enseignant'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function findone($id)
    {
        $sql = "SELECT * FROM users WHERE `id` = '$id'";//bch njib utilisateur bel ID 
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $u = $liste->fetch();
            return $u;// Retourner utilisateur trouvé (ou null si mouch mawjoud)
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function update($user, $id)
    {
        $sql = "UPDATE `users` SET `nom`=:nom,`prenom`=:prenom,`email`=:email,`password`=:password,`age`=:age,`type`=:type WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([ // Exécution avec données jdida
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'age' => $user->getAge(),
                'type' => $user->getType(),
                'id' => $id,

            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function delete()
    {
        if (isset($_GET['delete'])) { // Netcheckiw ken fam paramètre 'delete' fel URL
            $db = config::getConnexion(); // Connexion
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];// Nekhdhou ID mel URL
                $sql = "DELETE FROM `users` WHERE `id` = '$id' ";// Requête SQL bch nfas5ou utilisateur 
                $req = $db->prepare($sql);
                try {
                    $req->execute();// Exécution suppression
                    header("Location:users.php");// Nemchiw l users.php après suppression
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }
}
