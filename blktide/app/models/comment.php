<?php

namespace App\Models;

use PDO;

class Comment
{
    private $id;
    private $userId;
    private $imageId;
    private $content;
    private $createdAt;

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getImageId()
    {
        return $this->imageId;
    }

    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
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
        $stmt = $db->prepare("INSERT INTO comments (user_id, image_id, content, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->userId, $this->imageId, $this->content, $this->createdAt]);

        // Set the ID of the comment
        $this->id = $db->lastInsertId();
    }

    public static function findByImage($imageId)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT * FROM comments WHERE image_id = ?");
        $stmt->execute([$imageId]);

        // Fetch the comment data
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $comments = [];

        foreach ($data as $row) {
            // Create a Comment instance for each comment
            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->userId = $row['user_id'];
            $comment->imageId = $row['image_id'];
            $comment->content = $row['content'];
            $comment->createdAt = $row['created_at'];

            $comments[] = $comment;
        }

        return $comments;
    }

    // Add additional methods as needed
}

