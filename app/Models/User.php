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

    public function register($full_name, $email, $password, $role = 'user')
    {
        $this->setQuery("INSERT INTO users (email, password, full_name, role) VALUES (?, ?, ?, ?)");
        return $this->execute([$email, $password, $full_name, $role]);
    }

    public function findByEmail($email)
    {
        $this->setQuery("SELECT * FROM users WHERE email = ?");
        return $this->loadRow([$email]);
    }

    public function setResetToken($email, $token, $expiry)
    {
        $this->setQuery("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        return $this->execute([$token, $expiry, $email]);
    }

    public function findByToken($token)
    {
        $this->setQuery("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > ?");
        return $this->loadRow([$token, date('Y-m-d H:i:s')]);
    }

    public function updatePassword($email, $password)
    {
        $this->setQuery("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
        return $this->execute([$password, $email]);
    }

    public function getNumberOfUsers()
    {
        $this->setQuery("SELECT COUNT(*) as count FROM users");
        return $this->loadRow()->count;
    }

    public function getAllUsers()
    {
        $this->setQuery("SELECT * FROM users");
        return $this->loadAllRows();
    }

    public function deleteUser($userId)
    {
        $this->setQuery("DELETE FROM users WHERE id = ?");
        return $this->execute([$userId]);
    }

    public function getUser($userId)
    {
        $this->setQuery("SELECT * FROM users WHERE id = ?");
        return $this->loadRow([$userId]);
    }

    public function updateUser($userId, $data)
    {
        $this->setQuery("UPDATE users SET full_name = ?, email = ?, password = ?, role = ? WHERE id = ?");
        return $this->execute([$data['full_name'], $data['email'], $data['password'], $data['role'], $userId]);
    }
}
