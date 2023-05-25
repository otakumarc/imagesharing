<?php

// Define the base path of your application
define('BASE_PATH', __DIR__);

// Load the configuration
require_once '/config/config.php';


// Load the necessary files
require_once BASE_PATH . '/router.php';
require_once BASE_PATH . '/controller.php';
require_once BASE_PATH . '/models/user.php';
require_once BASE_PATH . '/models/comment.php';
require_once BASE_PATH . '/models/like.php';
require_once BASE_PATH . '/models/message.php';

// Create a new instance of the router
$router = new Router();

// Load the routes
require_once BASE_PATH . '/routes.php';

// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI']);
