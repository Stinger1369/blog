<?php

namespace Controllers;

use Models\Post;
use Models\Comment;

class PostController
{
  public function index()
  {
    // Récupération de tous les posts
    $posts = Post::getAll();

    // Affichage de la vue admin/posts/index.php avec les données récupérées
    require __DIR__ . '/../views/admin/index.php';
  }
  public function getAllPosts()
  {
    $posts = Post::getAll();
    return $posts;
  }
  public function create()
  {
    // Affichage de la vue admin/posts/create.php pour créer un nouveau post
    require __DIR__ . '/../views/admin/create.php';
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
    header('Location: /admin');
  }

  public function edit()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      //echo 'Fonction edit appelée avec id: ' . $id . '<br>';
      // Récupération du post correspondant à l'identifiant $id
      $post = Post::getById($id);
      //var_dump($id);

      if (!$post) {
        // Redirige vers la page d'erreur 404 si le post n'existe pas
        require __DIR__ . '/../Views/errors/404.php';
        exit;
      }

      // Récupération des données du post
      $title = isset($_POST['title']) ? $_POST['title'] : $post->getTitle();
      $body = isset($_POST['body']) ? $_POST['body'] : $post->getBody();

      // Affichage de la vue admin/edit-post.php avec les données récupérées
      require __DIR__ . '/../Views/admin/edit-post.php';
    } else {
      // Redirige vers la page d'erreur 404 si l'ID du post n'est pas défini
      require __DIR__ . '/../Views/errors/404.php';
    }
  }




  public function update()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      // Vérification de la méthode de requête HTTP
      if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/admin/edit-post?id=' . $id);
        exit;
      }

      // Récupération des données du formulaire d'édition de post
      $title = $_POST['title'];
      $body = $_POST['body'];

      // Récupération du post correspondant à l'identifiant $id
      $post = Post::getById($id);
      if (!$post) {
        header('Location: ' . BASE_URL . '/admin');
        exit;
      }

      // Mise à jour des données du post
      $post->setTitle($title);
      $post->setBody($body);
      $post->setUpdatedAt(date('Y-m-d H:i:s'));
      $post->save();

      // Redirection vers la page d'administration des posts
      header('Location: ' . BASE_URL . '/admin');
      exit;
    } else {
      // Rediriger vers une page d'erreur ou montrer un message d'erreur
    }
  }




  public function delete()
  {
    // Récupération du post correspondant à l'identifiant $id
    $id = $_POST['id'];
    $post = Post::getById($id);

    // Suppression du post
    $post->delete();

    // Redirection vers la page d'administration des posts
    header('Location: ' . BASE_URL . '/admin');
    exit;
  }


// ajouter post
  public function savePostAction()
  {
    // Vérifier si le formulaire a été soumis
    if (empty($_POST['title']) || empty($_POST['body'])) {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $body = $_POST['body'];
    $userId = $_SESSION['user_id'];

    // Créer un nouvel objet Post avec la date de création
    $created_at = date('Y-m-d H:i:s');
    $post = new Post($title, $body, $userId, null, $created_at);

    // Sauvegarder le nouvel objet Post dans la base de données
    $post->save();

    // Rediriger vers la liste des articles
    header('Location: ' . BASE_URL . '/admin');
    exit;
  }

  public function addPost()
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Inclure le fichier de vue 'admin/add-post.php'
    require_once(__DIR__ . '/../Views/admin/add-post.php');
  }


  public function show($vars)
  {
    // Récupération de l'ID du post depuis l'URL
    $id = $vars['id'];

    // Récupération du post correspondant à l'identifiant $id
    $post = Post::getById($id);

    // Récupération des commentaires associés au post
    $comments = Comment::getByPostId($id);
    //var_dump($comments);

    // Affichage de la vue home/show.php avec les données récupérées
    require __DIR__ . '/../views/home/show.php';
  }


}
