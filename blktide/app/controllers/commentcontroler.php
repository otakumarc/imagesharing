<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
    public function add($imageId)
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

        // Handle comment form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $content = $_POST['content'];

            // Create a new Comment instance
            $comment = new Comment();
            $comment->user_id = $userId;
            $comment->image_id = $imageId;
            $comment->content = $content;
            $comment->save();

            // Redirect to the image view page or any other appropriate page
            header('Location: ' . BASE_URL . '/image/view/' . $imageId);
            exit();
        }

        // Render the comment form
        include_once '../views/comment/add.php';
    }

    public function delete($commentId)
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

        // Find the comment by ID
        $comment = Comment::findById($commentId);

        if ($comment) {
            // Check if the user owns the comment
            if ($comment->user_id === $userId) {
                // Delete the comment
                $comment->delete();
            }
        }

        // Redirect to the image view page or any other appropriate page
        header('Location: ' . BASE_URL . '/image/view/' . $comment->image_id);
        exit();
    }
}

