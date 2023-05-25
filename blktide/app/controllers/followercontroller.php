<?php

namespace App\Controllers;

use App\Models\Follow;

class FollowController
{
    public function follow($userId)
    {
        // Check if the user is logged in
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Get the follower's user ID from the session
        $followerId = $_SESSION['user_id'];

        // Check if the user is trying to follow themselves
        if ($userId == $followerId) {
            // Show error message or redirect to appropriate page
            $error = 'You cannot follow yourself';
            include_once '../views/error.php';
            exit();
        }

        // Check if the user is already being followed
        $existingFollow = Follow::findByUserAndFollower($userId, $followerId);

        if ($existingFollow) {
            // User is already being followed, show error message or redirect to appropriate page
            $error = 'You are already following this user';
            include_once '../views/error.php';
        } else {
            // Create a new Follow instance
            $follow = new Follow();
            $follow->user_id = $userId;
            $follow->follower_id = $followerId;
            $follow->save();

            // Redirect to the user's profile page or any other appropriate page
            header('Location: ' . BASE_URL . '/user/profile/' . $userId);
            exit();
        }
    }

    public function unfollow($userId)
    {
        // Check if the user is logged in
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Get the follower's user ID from the session
        $followerId = $_SESSION['user_id'];

        // Find the follow by user and follower
        $follow = Follow::findByUserAndFollower($userId, $followerId);

        if ($follow) {
            // Delete the follow
            $follow->delete();
        }

        // Redirect to the user's profile page or any other appropriate page
        header('Location: ' . BASE_URL . '/user/profile/' . $userId);
        exit();
    }
}

