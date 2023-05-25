<?php

// Define your application routes

$router->get('/', 'HomeController@index');
$router->get('/auth/login', 'AuthController@showLogin');
$router->post('/auth/login', 'AuthController@login');
$router->get('/auth/register', 'AuthController@showRegister');
$router->post('/auth/register', 'AuthController@register');
$router->post('/auth/logout', 'AuthController@logout');

$router->get('/feed', 'FeedController@index');
$router->post('/feed/loadmore', 'FeedController@loadMore');

$router->get('/user/profile/{username}', 'UserController@profile');
$router->post('/user/follow', 'UserController@follow');
$router->post('/user/unfollow', 'UserController@unfollow');

$router->post('/like/like', 'LikeController@like');
$router->post('/like/unlike', 'LikeController@unlike');

$router->post('/comment/add', 'CommentController@add');

$router->get('/messaging', 'MessagingController@index');
$router->post('/messaging/send', 'MessagingController@send');
$router->get('/messaging/view/{conversationId}', 'MessagingController@view');

// ... Define more routes as needed

