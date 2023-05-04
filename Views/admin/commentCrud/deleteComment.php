<!-- Views/admin/commentCrud/deleteComment.php -->

<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Controllers\CommentController;

$commentController = new CommentController();
$commentId = $_POST['id'];
$commentController->destroy($commentId);
