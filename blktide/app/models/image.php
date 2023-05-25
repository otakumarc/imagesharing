<?php

namespace App\Models;

use PDO;

class Image
{
    private $id;
    private $userId;
    private $filename;
    private $caption;
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

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
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
        $stmt = $db->prepare("INSERT INTO images (user_id, filename, caption, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->userId, $this->filename, $this->caption, $this->createdAt]);

        // Set the ID of the image
        $this->id = $db->lastInsertId();
    }

    public static function findById($id)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT * FROM images WHERE id = ?");
        $stmt->execute([$id]);

        // Fetch the image data
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Create an Image instance
        $image = new Image();
        $image->id = $data['id'];
        $image->userId = $data['user_id'];
        $image->filename = $data['filename'];
        $image->caption = $data['caption'];
        $image->createdAt = $data['created_at'];

        return $image;
    }

    // Add additional methods as needed
}

