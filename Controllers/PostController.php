<?php

namespace Controllers;

use Models\Post;

class PostController
{
  public function index()
  {
    // Récupération de tous les posts
    $posts = Post::getAll();

    // Affichage de la vue admin/posts/index.php avec les données récupérées
    require __DIR__ . '/../views/admin/posts/index.php';
  }

  public function create()
  {
    // Affichage de la vue admin/posts/create.php pour créer un nouveau post
    require __DIR__ . '/../views/admin/posts/create.php';
  }

  public function store()
  {
    // Récupération des données du formulaire de création de post
    $title = $_POST['title'];
    $body = $_POST['body'];
    $userId = $_POST['user_id'];

    // Création du nouveau post
    $post = new Post($title, $body, $userId);
    $post->save();

    // Redirection vers la page d'administration des posts
    header('Location: /admin/posts');
  }

  public function edit($id)
  {
    // Récupération du post correspondant à l'identifiant $id
    $post = Post::getById($id);

    // Affichage de la vue admin/posts/edit.php avec les données récupérées
    require __DIR__ . '/../views/admin/posts/edit.php';
  }

  public function update($id)
  {
    // Récupération des données du formulaire d'édition de post
    $title = $_POST['title'];
    $body = $_POST['body'];

    // Récupération du post correspondant à l'identifiant $id
    $post = Post::getById($id);

    // Mise à jour des données du post
    $post->setTitle($title);
    $post->setBody($body);
    $post->setUpdatedAt(date('Y-m-d H:i:s'));
    $post->save();

    // Redirection vers la page d'administration des posts
    header('Location: /admin/posts');
  }

  public function delete($params)
  {
    // Récupération du post correspondant à l'identifiant $id
    $id = $params['id'];
    $post = Post::getById($id);

    // Suppression du post
    $post->delete();

    // Redirection vers la page d'administration des posts
    header('Location: /admin/posts');
  }
}
