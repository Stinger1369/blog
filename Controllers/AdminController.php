<?php

namespace Controllers;

use Models\Post;
use Models\User;
use Config\Database;

class AdminController
{
  public function index()
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Afficher un message de bienvenue
    $welcomeMessage = "Bienvenue sur la page d'administration, " . $_SESSION['user_name'] . "!";

    // Récupérer tous les posts
    $posts = Post::getAll();

    // Afficher la page d'administration avec la liste des posts
    require_once(__DIR__ . '/../Views/admin/index.php');
  }

  public function users()
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Récupérer tous les utilisateurs
    $users = User::getAll();

    // Afficher la page d'administration avec la liste des utilisateurs
    require_once(__DIR__ . '/../Views/admin/manage-users.php');
  }

  public static function deleteById($id)
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare('DELETE FROM user WHERE id = ?');
    $stmt->execute([$id]);
  }
  public function editUser($params)
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Récupérer l'id de l'utilisateur à éditer
    $id = $params['id'];

    // Récupérer les informations de l'utilisateur à éditer
    $user = User::getById($id);

    // Afficher le formulaire d'édition d'un utilisateur
    require_once(__DIR__ . '/../Views/admin/edit-user.php');
  }

  public function updateUser($params)
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Récupérer l'id de l'utilisateur à mettre à jour
    $id = $params['id'];

    // Récupérer les informations de l'utilisateur à mettre à jour
    $user = User::getById($id);

    // Mettre à jour les informations de l'utilisateur
    $user->setName($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setRole($_POST['role']);
    $user->save();

    // Rediriger vers la page de gestion des utilisateurs
    header('Location: ' . BASE_URL . '/admin/users');
    exit;
  }

  public function deleteUser($params)
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Récupérer l'id de l'utilisateur à supprimer
    $id = $params['id'];

    // Supprimer l'utilisateur
    $user = User::getById($id);
    $user->delete();

    // Rediriger vers la page de gestion des utilisateurs
    header('Location: ' . BASE_URL . '/admin/users');
    exit;
  }
  public function savePost()
  {
    // Inclure le fichier de vue 'admin/save-post.php'
    require_once(__DIR__ . '/../Views/admin/save-post.php');
  }

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
}
