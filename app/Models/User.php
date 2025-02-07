<?php

namespace App\Models;

use App\Models\BaseModel;

class User extends BaseModel
{
    public function login($email, $password)
    {
        $this->setQuery("SELECT * FROM users WHERE email = ? AND password = ?");
        return $this->loadRow([$email, $password]);
    }

    public function register($full_name, $email, $password)
    {
        $this->setQuery("INSERT INTO users (email, password, full_name) VALUES (?, ?, ?)");
        return $this->execute([$email, $password, $full_name]);
    }
}
