<?php

namespace Controllers;

use Config\Database;
use Models\Post;
use Models\Comment;

class HomeController
{
  public function index()
  {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 12;
    $offset = ($page - 1) * $limit;

    // Récupération des 12 derniers posts
    $posts = Post::getLatestPosts($limit, $offset);
    $totalPosts = Post::getTotalPosts();
    $totalPages = ceil($totalPosts / $limit);

    // Affichage de la vue home/index.php avec les données récupérées
    require __DIR__ . '/../views/home/index.php';
  }


  public static function getLatestPosts($limit)
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare('SELECT * FROM posts ORDER BY created_at DESC LIMIT :limit');
    $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
    $stmt->execute();

    $posts = [];

    while ($row = $stmt->fetch()) {
      $post = new Post($row['title'], $row['body'], $row['userId'] ?? null, $row['id'], $row['created_at'], $row['updated_at'] ?? null);
      $post->setComments(Comment::getCommentsForPost($post->getId())); // fetch comments for post
      $posts[] = $post;
    }

    return $posts;
  }

  public static function getCommentsForPost($postId)
  {
    $comments = Comment::getByPostId($postId);
    return $comments;
  }

}
