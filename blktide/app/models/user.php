<?php

namespace App\Models;

use PDO;

class User
{
    private $id;
    private $username;
    private $password;
    private $email;

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Other methods

    public function save()
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$this->username, $this->password, $this->email]);

        // Set the ID of the user
        $this->id = $db->lastInsertId();
    }

    public static function findById($id)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);

        // Fetch the user data
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Create a User instance
        $user = new User();
        $user->id = $data['id'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->email = $data['email'];

        return $user;
    }

    // Add additional methods as needed
}

