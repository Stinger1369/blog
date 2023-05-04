<?php

namespace Controllers;

use Models\Post;

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


}
