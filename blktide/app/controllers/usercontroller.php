<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function register()
    {
        // Handle registration form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate form data (you can add your validation logic here)

            // Create a new User instance
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            // Hash the password before storing
            $user->password = password_hash($password, PASSWORD_DEFAULT);

            // Save the user to the database
            $user->save();

            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Render the registration form
        include_once '../views/auth/register.php';
    }

    public function login()
    {
        // Handle login form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Find the user by username
            $user = User::findByUsername($username);

            // Verify password and log in if valid
            if ($user && password_verify($password, $user->password)) {
                // Start the session and set the user ID
                session_start();
                $_SESSION['user_id'] = $user->id;

                // Redirect to the user's profile page or any other appropriate page
                header('Location: ' . BASE_URL . '/user/profile');
                exit();
            } else {
                // Invalid credentials, show error message
                $error = 'Invalid username or password';
            }
        }

        // Render the login form
        include_once '../views/auth/login.php';
    }

    public function logout()
    {
        // Destroy the session and redirect to the login page or any other appropriate page
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . '/auth/login');
        exit();
    }
}

