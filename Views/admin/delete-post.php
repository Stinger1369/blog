<?php
// /blog/Views/admin/delete-post.php

require_once __DIR__ . '/../../vendor/autoload.php';

use Controllers\PostController;

$postController = new PostController();
$postId = $_POST['id'];
$postController->delete(['id' => $postId]); // Pass an array with 'id' key to match the method signature

header('Location: /Blog/admin');
