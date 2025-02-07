<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        $error = '';
        // if request method is post
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['full_name'])) {
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
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full_name'])) {
            $user = new User();
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user->register($full_name, $email, $password);
        }
        return $this->render('pages.auth.login', compact('error'));
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        session_unset();
        session_destroy();
        header("Location: ./login");
    }
}
