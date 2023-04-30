<?php
require_once __DIR__ . '/../../Models/Post.php';
require_once __DIR__ . '/../../Controllers/PostController.php';

use Models\Post;

// Vérifier si un post id est fourni
if (!isset($_GET['id'])) {
  header('Location: /admin/posts');
  exit;
}

// Récupérer le post correspondant à l'id
$post = Post::getById($_GET['id']);
if (!$post) {
  header('Location: /admin/posts');
  exit;
}

// Traitement du formulaire d'édition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données du formulaire
  $title = $_POST['title'];
  $body = $_POST['body'];

  // Mise à jour du post
  $post->setTitle($title);
  $post->setBody($body);
  $post->setUpdatedAt(date('Y-m-d H:i:s'));
  $post->save();

  // Redirection vers la page d'administration
  header('Location: /Blog/admin');
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Édition de post</title>
</head>

<body>
  <h1>Édition de post</h1>
  <form method="POST">
    <div>
      <label for="title">Titre :</label>
      <input type="text" id="title" name="title" value="<?= $post->getTitle() ?>">
    </div>
    <div>
      <label for="body">Contenu :</label>
      <textarea id="body" name="body"><?= $post->getBody() ?></textarea>
    </div>
    <button type="submit">Enregistrer</button>
  </form>
</body>

</html>
