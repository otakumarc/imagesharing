<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Image;

class SearchController
{
    public function searchUsers()
    {
        // Check if the search query is provided
        if (isset($_GET['query'])) {
            $query = $_GET['query'];

            // Perform the search query on users
            $users = User::search($query);

            // Render the search results page for users
            include_once '../views/search/users.php';
        } else {
            // Show an empty search page or redirect to appropriate page
            include_once '../views/search/empty.php';
        }
    }

    public function searchImages()
    {
        // Check if the search query is provided
        if (isset($_GET['query'])) {
            $query = $_GET['query'];

            // Perform the search query on images
            $images = Image::search($query);

            // Render the search results page for images
            include_once '../views/search/images.php';
        } else {
            // Show an empty search page or redirect to appropriate page
            include_once '../views/search/empty.php';
        }
    }
}

