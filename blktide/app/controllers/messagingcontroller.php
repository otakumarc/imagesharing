<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Message;

class MessagingController
{
    public function sendMessage($recipientId)
    {
        // Check if the user is logged in
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Get the sender's user ID from the session
        $senderId = $_SESSION['user_id'];

        // Check if the recipient exists
        $recipient = User::findById($recipientId);

        if (!$recipient) {
            // Show error message or redirect to appropriate page
            $error = 'Recipient does not exist';
            include_once '../views/error.php';
            exit();
        }

        // Handle message form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $content = $_POST['content'];

            // Create a new Message instance
            $message = new Message();
            $message->sender_id = $senderId;
            $message->recipient_id = $recipientId;
            $message->content = $content;
            $message->save();

            // Redirect to the messaging page or any other appropriate page
            header('Location: ' . BASE_URL . '/messaging');
            exit();
        }

        // Render the messaging form
        include_once '../views/messaging/send.php';
    }

    public function viewMessages()
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

        // Get the user's messages
        $messages = Message::findByUser($userId);

        // Render the messaging view page
        include_once '../views/messaging/view.php';
    }
}

