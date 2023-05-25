<?php

namespace App\Models;

use PDO;

class Tag
{
    private $id;
    private $name;

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Other methods

    public function save()
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO tags (name) VALUES (?)");
        $stmt->execute([$this->name]);

        // Set the ID of the tag
        $this->id = $db->lastInsertId();
    }

    public static function findByName($name)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT * FROM tags WHERE name = ?");
        $stmt->execute([$name]);

        // Fetch the tag data
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Create a Tag instance
        $tag = new Tag();
        $tag->id = $data['id'];
        $tag->name = $data['name'];

        return $tag;
    }

    // Add additional methods as needed
}

