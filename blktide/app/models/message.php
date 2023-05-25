<?php

namespace App\Models;

use PDO;

class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $content;
    private $createdAt;

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    // Other methods

    public function save()
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO messages (sender_id, receiver_id, content, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->senderId, $this->receiverId, $this->content, $this->createdAt]);

        // Set the ID of the message
        $this->id = $db->lastInsertId();
    }

    public static function findByUser($userId)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ?");
        $stmt->execute([$userId, $userId]);

        // Fetch the message data
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $messages = [];

        foreach ($data as $row) {
            // Create a Message instance for each message
            $message = new Message();
            $message->id = $row['id'];
            $message->senderId = $row['sender_id'];
            $message->receiverId = $row['receiver_id'];
            $message->content = $row['content'];
            $message->createdAt = $row['created_at'];

            $messages[] = $message;
        }

        return $messages;
    }

    // Add additional methods as needed
}

