<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function __construct()
    {
        if (isset($_SESSION['user'])) {
            header("Location: ./");
        }
    }

    public function sendResetLink()
    {
        $error = '';
        $success = '';
        $page = 'reset';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $userModel->setResetToken($email, $token, $expiry);

                $resetLink = BASE_URL . "reset-password?token=" . $token;
                mail($email, "Password Reset", "Click the following link to reset your password: $resetLink");

                $success = "A password reset link has been sent to your email.";
            } else {
                $error = "Email not found.";
            }
        }

        return $this->render('pages.auth.login', compact('error', 'success', 'page'));
    }

    public function showResetPassword()
    {
        return $this->render('pages.auth.reset');
    }

    public function resetPassword()
    {
        $success = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $newPassword = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByToken($token);

            if ($user) {
                $userModel->updatePassword($user->email, $newPassword);
                $success = "Your password has been reset successfully.";
            } else {
                $error = "Invalid or expired token.";
            }
        }

        return $this->render('pages.auth.reset', compact('error', 'success'));
    }

    public function login()
    {
        $error = '';
        $page = 'login';
        // if request method is post
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $user = new User();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $auth = $user->login($email, $password);
            if ($auth) {
                $_SESSION['user'] = $auth;
                header("Location: ./");
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
            $user = new User();
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user->register($full_name, $email, $password);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forgot'])) {
            return $this->sendResetLink();
        }
        return $this->render('pages.auth.login', compact('error', 'page'));
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        session_unset();
        session_destroy();
        header("Location: ./login");
    }
}
