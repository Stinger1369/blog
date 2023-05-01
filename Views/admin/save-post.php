<?php
// require_once __DIR__ . '/../../config/config.php';
// require_once __DIR__ . '/../../vendor/autoload.php'; // Ajoutez cette ligne pour charger AltoRouter

// use Models\Post;

// // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
//   header('Location: ' . BASE_URL . '/');
//   exit;
// }

// // Vérifier si le formulaire a été soumis
// if (empty($_POST['title']) || empty($_POST['body'])) {
//   header('Location: ' . BASE_URL . '/');
//   exit;
// }

// // Récupérer les données du formulaire
// $title = $_POST['title'];
// $body = $_POST['body'];
// $userId = $_SESSION['user_id'];

// // Créer un nouvel objet Post
// $post = new Post($title, $body, $userId);

// // Sauvegarder le nouvel objet Post dans la base de données
// $post->save();

// // Rediriger vers la liste des articles
// header('Location: ' . BASE_URL . 'Blog/admin');
