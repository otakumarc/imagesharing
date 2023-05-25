<?php

namespace App\Models;

use PDO;

class Like
{
    private $id;
    private $userId;
    private $imageId;

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

    // Other methods

    public function save()
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO likes (user_id, image_id) VALUES (?, ?)");
        $stmt->execute([$this->userId, $this->imageId]);
    }

    public static function findByUserAndImage($userId, $imageId)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT * FROM likes WHERE user_id = ? AND image_id = ?");
        $stmt->execute([$userId, $imageId]);

        // Fetch the like data
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Create a Like instance
        $like = new Like();
        $like->id = $data['id'];
        $like->userId = $data['user_id'];
        $like->imageId = $data['image_id'];

        return $like;
    }

    // Add additional methods as needed
}

