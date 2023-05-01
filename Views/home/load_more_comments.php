<?php
// // load_more_comments.php

// require_once __DIR__ . '/../partials/header.php';

// $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
// $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
// $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 2;

// if ($post_id > 0) {
//   $comments = get_comments_by_post_id($post_id, $offset, $limit);
//   echo json_encode($comments);
// } else {
//   http_response_code(400);
//   echo json_encode(['error' => 'Invalid post_id']);
// }
