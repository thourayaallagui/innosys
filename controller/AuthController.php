<?php
session_start();
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/SmsService.php';

class AuthController {
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $user = (new UserModel())->getUserByEmail($email);
            
            if ($user) {
                $_SESSION['reset_user'] = $user;
                header('Location: verify-code.php');
                exit;
            } else {
                $error = "Email non trouvé";
                require '../views/forgot-password.php';
            }
        } else {
            require '../views/forgot-password.php';
        }
    }

    public function verifyCode() {
        if (empty($_SESSION['reset_user'])) {
            header('Location: forgot-password.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            if ($code == $_SESSION['reset_code']) {
                header('Location: reset-password.php');
                exit;
            } else {
                $error = "Code incorrect";
            }
        }

        if (!isset($_SESSION['reset_code'])) {
            $_SESSION['reset_code'] = rand(1000, 9999);
            (new SmsService())->send(
                $_SESSION['reset_user']['telephone'],
                "Votre code de réinitialisation: ".$_SESSION['reset_code']
            );
        }

        require '../views/verify-code.php';
    }

    public function resetPassword() {
        if (empty($_SESSION['reset_user'])) {
            header('Location: forgot-password.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];
            
            if ($password === $confirm) {
                (new UserModel())->updatePassword(
                    $_SESSION['reset_user']['id'],
                    password_hash($password, PASSWORD_BCRYPT)
                );
                unset($_SESSION['reset_user']);
                unset($_SESSION['reset_code']);
                header('Location: login.php?reset=success');
                exit;
            } else {
                $error = "Les mots de passe ne correspondent pas";
            }
        }

        require '../views/reset-password.php';
    }
}
?>