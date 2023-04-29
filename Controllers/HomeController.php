<?php

namespace Controllers;

use Models\Post;

class HomeController
{
  public function index()
  {

    // Récupération des 12 derniers posts
    $posts = Post::getLatestPosts(12);
    echo 'Nombre de posts récupérés : ' . count($posts);
    // Affichage de la vue home/index.php avec les données récupérées
    require __DIR__ . '/../views/home/index.php';
  }

  public function show($vars)
  {
    // Récupération de l'ID du post depuis l'URL
    $id = $vars['id'];

    // Récupération du post correspondant à l'identifiant $id
    $post = Post::getById($id);

    // Récupération des commentaires associés au post
    $comments = $post->getComments();

    // Affichage de la vue home/show.php avec les données récupérées
    require __DIR__ . '/../views/home/show.php';
  }
}
