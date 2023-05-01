<?php

// namespace Controllers;

// use Models\Comment;

// class CommentController
// {
//   /**
//    * Show the comments associated with a post.
//    */
//   public function show($postId)
//   {
//     $comments = Comment::getAllByPostId($postId);
//     require_once __DIR__ . '/../views/partials/header.php';
//     require_once __DIR__ . '/../views/comments/index.php';
//     require_once __DIR__ . '/../views/partials/footer.php';
//   }

//   /**
//    * Store a new comment in the database.
//    */
//   public function store()
//   {
//     if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['body'])) {
//       $_SESSION['error'] = 'Tous les champs sont requis.';
//       header('Location: /posts/' . $_POST['post_id']);
//       exit();
//     }

//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $body = $_POST['body'];
//     $postId = $_POST['post_id'];

//     $comment = new Comment($postId, $name, $email, $body);
//     $comment->save();

//     $_SESSION['success'] = 'Le commentaire a été ajouté avec succès.';
//     header('Location: /posts/' . $postId);
//     exit();
//   }

//   /**
//    * Show the edit form for a comment.
//    */
//   public function edit($commentId)
//   {
//     $comment = Comment::findById($commentId);
//     require_once __DIR__ . '/../views/partials/header.php';
//     require_once __DIR__ . '/../views/comments/edit.php';
//     require_once __DIR__ . '/../views/partials/footer.php';
//   }

//   /**
//    * Update a comment in the database.
//    */
//   public function update()
//   {
//     if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['body'])) {
//       $_SESSION['error'] = 'Tous les champs sont requis.';
//       header('Location: /comments/' . $_POST['id'] . '/edit');
//       exit();
//     }

//     $id = $_POST['id'];
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $body = $_POST['body'];

//     $comment = Comment::findById($id);
//     $comment->setUserId($name);
//     $comment->setBody($body);
//     $comment->setUpdatedAt(date('Y-m-d H:i:s'));
//     $comment->save();

//     $_SESSION['success'] = 'Le commentaire a été modifié avec succès.';
//     header('Location: /posts/' . $comment->getPostId());
//     exit();
//   }
//   /**
//    * Delete a comment from the database.
//    */

//   public function destroy($commentId)
//   {
//     $comment = Comment::findById($commentId);
//     $postId = $comment->getPostId();
//     $comment->delete();

//     $_SESSION['success'] = 'Le commentaire a été supprimé avec succès.';
//     header('Location: /posts/' . $postId);
//     exit();
//   }
// }
