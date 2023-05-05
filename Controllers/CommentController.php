<?php

namespace Controllers;

use Models\Comment;
use Models\Post;

use Exception;

class CommentController
{
  /**
   * Show the comments associated with a post.
   */
  public function show($postId)
  {
    $post = Post::getById($postId);
    $comments = Comment::getByPostId($postId);
    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/home/show.php';
    require_once __DIR__ . '/../views/partials/footer.php';
  }

  public function index()
  {
    $comments = Comment::getAll();
    require_once __DIR__ . '/../Views/admin/commentCrud/index.php';
  }

  public function indexByPostId($postId)
  {
    $comments = Comment::getAllByPostId($postId);
    require_once __DIR__ . '/../Views/admin/commentCrud/index.php';
  }
  /**
   * Store a new comment in the database.
   */
  public function store()
  {
    // Récupérer les données du formulaire
    $postId = $_POST['post_id'];
    $email = $_POST['email'];
    $body = $_POST['body'];

    // Créer un nouvel objet Comment
    $comment = new Comment();
    $comment->setPostId($postId);
    $comment->setEmail($email);
    $comment->setBody($body);

    // Enregistrer le commentaire dans la base de données
    $comment->save();

    // Rediriger vers la page du poste avec le commentaire ajouté
    header('Location: ' . BASE_URL . '/post/' . $postId);
    exit();
  }

  public function editComment($params)
  {
    $id = $params['id'];
    // Récupération du commentaire correspondant à l'identifiant $id
    $comment = Comment::getById($id);

    if (!$comment) {
      // Redirige vers la page d'erreur 404 si le commentaire n'existe pas
      require __DIR__ . '/../Views/errors/404.php';
      exit;
    }

    // Affichage de la vue admin/editcomment.php avec les données récupérées
    require __DIR__ . '/../Views/admin/commentCrud/editComment.php';
  }

  public function updateComment()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      // Vérification de la méthode de requête HTTP
      if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/admin/commentCrud/editcomment/' . $id);
        exit;
      }

      // Récupération des données du formulaire d'édition de commentaire
      $name = $_POST['name'];
      $email = $_POST['email'];
      $body = $_POST['body'];

      // Récupération du commentaire correspondant à l'identifiant $id
      $comment = Comment::getById($id);
      if (!$comment) {
        header('Location: ' . BASE_URL . '/admin/crudCommment/updateComment ' . $id);
        exit;
      }

      // Mise à jour des données du commentaire
      $comment->setName($name);
      $comment->setEmail($email);
      $comment->setBody($body);
      $comment->setCreated_At(date('Y-m-d H:i:s'));
      $comment->setUpdated_At(date('Y-m-d H:i:s'));
      $comment->save();

      // Redirection vers la page d'administration des commentaires
      header('Location: ' . BASE_URL . '/admin/commentCrud/index');
      exit;
    } else {
      // Rediriger vers une page d'erreur ou montrer un message d'erreur
    }
  }
  /**
   * Delete a comment from the database.
   */

  public function destroy($params)
  {
    $commentId = $params['id'];
    $comment = Comment::findById($commentId);
    $comment->delete();

    $_SESSION['success'] = 'Le commentaire a été supprimé avec succès.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }


  public function loadMoreComments($post_id, $offset, $limit)
  {
    ob_start(); // Start output buffering

    $comments = Comment::getAllByPostId($post_id, $limit, $offset);
    header('Content-Type: application/json');

    ob_end_clean();

    file_put_contents('log.txt', "Fonction loadMoreComments appelée\n", FILE_APPEND);

    echo json_encode($comments);
    exit();
  }

  // public function loadMore()
  // {
  //   $postId = $_GET['post_id'];
  //   $limit = $_GET['limit'];
  //   $offset = $_GET['offset'];

  //   $comments = Comment::getByPostId($postId, $limit, $offset);

  //   $response = array();
  //   foreach ($comments as $comment) {
  //     $response[] = array(
  //       'name' => $comment->getName(),
  //       'body' => $comment->getBody()
  //     );
  //   }

  //   header('Content-Type: application/json');
  //   file_put_contents('log.txt', "Fonction loadMore appelée\n", FILE_APPEND);
  //   echo json_encode($response);
  // }




  public function addComment()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $postId = $_POST['post_id'];
      $userId = $_SESSION['user_id'];
      $name = $_SESSION['user_name'];
      $email = $_POST['email'];
      $body = $_POST['body'];

      $comment = new Comment($postId, $name, $email, $body);
      $comment->setUserId($userId);
      $comment->createComment();

      header("Location: " . BASE_URL . "/posts/" . $postId);
    } else {
      header("Location: " . BASE_URL);
    }
  }

  public function create()
  {
    require __DIR__ . '/../Views/admin/commentCrud/createComment.php';
  }
}
