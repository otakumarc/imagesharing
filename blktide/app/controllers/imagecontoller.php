<?php

namespace App\Controllers;

use App\Models\Image;

class ImageController
{
    public function upload()
    {
        // Check if the user is logged in
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page or any other appropriate page
            header('Location: ' . BASE_URL . '/auth/login');
            exit();
        }

        // Handle image upload form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $userId = $_SESSION['user_id'];
            $image = $_FILES['image'];
            $description = $_POST['description'];

            // Validate form data (you can add your validation logic here)

            // Process the uploaded image
            $imagePath = $this->processImageUpload($image);

            // Create a new Image instance
            $imageObj = new Image();
            $imageObj->user_id = $userId;
            $imageObj->image_url = $imagePath;
            $imageObj->description = $description;

            // Save the image to the database
            $imageObj->save();

            // Redirect to the user's profile page or any other appropriate page
            header('Location: ' . BASE_URL . '/user/profile');
            exit();
        }

        // Render the image upload form
        include_once '../views/image/upload.php';
    }

    public function view($imageId)
    {
        // Get the image by ID
        $image = Image::findById($imageId);

        if ($image) {
            // Render the image view page
            include_once '../views/image/view.php';
        } else {
            // Image not found, show error message or redirect to appropriate page
            $error = 'Image not found';
            include_once '../views/error.php';
        }
    }

    private function processImageUpload($image)
    {
        // Define the allowed image file types
        $allowedTypes = ['image/jpeg', 'image/png'];

        // Check if the uploaded file is an image
        if (!in_array($image['type'], $allowedTypes)) {
            // Invalid file type, show error message or redirect to appropriate page
            $error = 'Invalid file type. Please upload a JPEG or PNG image.';
            include_once '../views/error.php';
            exit();
        }

        // Generate a unique filename for the uploaded image
        $fileName = uniqid() . '_' . $image['name'];

        // Move the uploaded image to the desired directory
        $destination = UPLOAD_DIR . $fileName;
        move_uploaded_file($image['tmp_name'], $destination);

        // Return the file path of the uploaded image
        return BASE_URL . '/uploads/' . $fileName;
    }
}

