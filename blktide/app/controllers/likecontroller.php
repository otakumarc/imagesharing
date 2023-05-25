<?php

namespace App\Controllers;

use App\Models\Like;

class LikeController
{
    public function like($imageId)
    {
        // Check if the user is logged in
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Check if the user has already liked the image
        $existingLike = Like::findByUserAndImage($userId, $imageId);

        if ($existingLike) {
            // User has already liked the image, show error message or redirect to appropriate page
            $error = 'You have already liked this image';
            include_once '../views/error.php';
        } else {
            // Create a new Like instance
            $like = new Like();
            $like->user_id = $userId;
            $like->image_id = $imageId;
            $like->save();

            // Redirect to the image view page or any other appropriate page
            header('Location: ' . BASE_URL . '/image/view/' . $imageId);
            exit();
        }
    }

    public function unlike($imageId)
    {
        // Check if the user is logged in
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Find the like by user and image
        $like = Like::findByUserAndImage($userId, $imageId);

        if ($like) {
            // Delete the like
            $like->delete();
        }

        // Redirect to the image view page or any other appropriate page
        header('Location: ' . BASE_URL . '/image/view/' . $imageId);
        exit();
    }
}

