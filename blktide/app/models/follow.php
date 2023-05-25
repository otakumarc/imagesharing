<?php

namespace App\Models;

use PDO;

class Follow
{
    private $followerId;
    private $followingId;

    // Getters and Setters

    public function getFollowerId()
    {
        return $this->followerId;
    }

    public function setFollowerId($followerId)
    {
        $this->followerId = $followerId;
    }

    public function getFollowingId()
    {
        return $this->followingId;
    }

    public function setFollowingId($followingId)
    {
        $this->followingId = $followingId;
    }

    // Other methods

    public function save()
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("INSERT INTO follows (follower_id, following_id) VALUES (?, ?)");
        $stmt->execute([$this->followerId, $this->followingId]);
    }

    public static function isFollowing($followerId, $followingId)
    {
        // Database connection
        $db = DB::getInstance();

        // Prepare the SQL statement
        $stmt = $db->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = ? AND following_id = ?");
        $stmt->execute([$followerId, $followingId]);

        // Fetch the count value
        $count = $stmt->fetchColumn();

        return ($count > 0);
    }

    // Add additional methods as needed
}

