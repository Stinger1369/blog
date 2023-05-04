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
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['body'])) {
      $_SESSION['error'] = 'Tous les champs sont requis.';
      header('Location: /posts/' . $_POST['post_id']);
      exit();
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $body = $_POST['body'];
    $postId = $_POST['post_id'];

    $comment = new Comment($postId, $name, $email, $body);
    $comment->save();

    $_SESSION['success'] = 'Le commentaire a été ajouté avec succès.';
    header('Location: /posts/' . $postId);
    exit();
  }

  public function edit($id)
  {
    // Récupération du commentaire correspondant à l'identifiant $id
    $comment = Comment::findById($id);

    if (!$comment) {
      // Redirige vers la page d'erreur 404 si le commentaire n'existe pas
      require __DIR__ . '/../Views/errors/404.php';
      exit;
    }

    // Récupération des données du commentaire
    $name = isset($_POST['name']) ? $_POST['name'] : $comment->getName();
    $email = isset($_POST['email']) ? $_POST['email'] : $comment->getEmail();
    $body = isset($_POST['body']) ? $_POST['body'] : $comment->getBody();

    // Affichage de la vue admin/edit-comment.php avec les données récupérées
    require __DIR__ . '/../Views/admin/commentCrud/editComment.php';
  }
  /**
   * Update a comment in the database.
   */
  public function update()
  {
    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['body'])) {
      $_SESSION['error'] = 'Tous les champs sont requis.';
      header('Location: /comments/' . $_POST['id'] . '/edit');
      exit();
    }

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $body = $_POST['body'];

    $comment = Comment::findById($id);
    $comment->setName($name); // Utilisez le bon setter
    $comment->setEmail($email); // Utilisez le bon setter
    $comment->setBody($body);
    $comment->setUpdated_at(date('Y-m-d H:i:s'));
    $comment->save();

    $_SESSION['success'] = 'Le commentaire a été modifié avec succès.';
    header('Location: /posts/' . $comment->getPostId());
    exit();
  }
  /**
   * Delete a comment from the database.
   */

  public function destroy($commentId)
  {
    $comment = Comment::findById($commentId);
    $postId = $comment->getPostId();
    $comment->delete();

    $_SESSION['success'] = 'Le commentaire a été supprimé avec succès.';
    header('Location: /posts/' . $postId);
    exit();
  }

  public function loadMoreComments($postId, $offset)
  {
    $comments = Comment::getAllByPostId($postId, 2, $offset);
    header('Content-Type: application/json');
    echo json_encode($comments);
    exit();
  }
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
  public function loadMore()
  {
    $postId = $_GET['post_id'];
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];

    $comments = Comment::getByPostId($postId, $limit, $offset);

    $response = array();
    foreach ($comments as $comment) {
      $response[] = array(
        'name' => $comment->getName(),
        'body' => $comment->getBody()
      );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
