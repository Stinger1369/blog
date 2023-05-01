<?php

namespace Controllers;
require_once __DIR__ . '/../Config/config.php';

use Models\Post;
use Models\User;
use Config\Database;

class AdminController
{
  public function index()
  {
    // Vérifier si l'utilisateur est connecté et est un administrateur
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
      $_SESSION['error_message'] = "Vous n'avez pas l'autorisation d'accéder à cette page.";
      header('Location: ' . BASE_URL);
      exit;
    }

    // Afficher la page d'administration
    require_once(__DIR__ . '/../Views/admin/index.php');
  }


  public function users()
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/admin');
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

    // Traitement du formulaire d'édition
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupérer les données soumises dans le formulaire
      $name = $_POST['name'];
      $email = $_POST['email'];
      $role = $_POST['role'];

      // Mettre à jour les informations de l'utilisateur
      $user->setName($name);
      $user->setEmail($email);
      $user->setRole($role);
      $user->save();

      // Rediriger l'utilisateur vers la page de gestion des utilisateurs
      header('Location: ' . BASE_URL . '/admin/manage-users');
      exit;
    }

    // Afficher le formulaire d'édition d'un utilisateur
    require_once(__DIR__ . '/../Views/admin/userCrud/userUpdate.php');
  }




  // public function updateUser($params)
  // {
  //   // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
  //   if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
  //     header('Location: ' . BASE_URL . '/');
  //     exit;
  //   }

  //   // Récupérer l'id de l'utilisateur à mettre à jour
  //   $id = $params['id'];

  //   // Récupérer les informations de l'utilisateur à mettre à jour
  //   $user = User::getById($id);

  //   // Mettre à jour les informations de l'utilisateur
  //   $user->setName($_POST['name']);
  //   $user->setEmail($_POST['email']);
  //   $user->setRole($_POST['role']);
  //   $user->save();

  //   // Rediriger vers la page de gestion des utilisateurs
  //   header('Location: ' . BASE_URL . '/admin/manage-users');
  //   exit;
  // }

  public function deleteUser($params)
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Récupérer l'id de l'utilisateur à supprimer
    $id = $params['id'];

    // Récupérer l'utilisateur à supprimer
    $user = User::getById($id);

    // Supprimer l'utilisateur
    $user->delete();

    // Rediriger l'utilisateur vers la page de gestion des utilisateurs
    header('Location: ' . BASE_URL . '/admin/manage-users');
    exit;
  }



  public function savePost()
  {
    // Inclure le fichier de vue 'admin/save-post.php'
    require_once(__DIR__ . '/../Views/admin/save-post.php');
  }


  public function addUser()
  {
    // Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
      header('Location: ' . BASE_URL . '/');
      exit;
    }

    // Traitement du formulaire de création
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupérer les données soumises dans le formulaire
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $role = $_POST['role'];

      // Créer un nouvel utilisateur et définir ses attributs
      $user = new User();
      $user->setName($name);
      $user->setEmail($email);
      $user->setPasswordHash(password_hash($password, PASSWORD_DEFAULT));
      $user->setRole($role);
      $user->setCreated_At(date("Y-m-d H:i:s"));

      // Enregistrer l'utilisateur
      $user->save();

      // Rediriger l'utilisateur vers la page de gestion des utilisateurs
      header('Location: ' . BASE_URL . '/admin/manage-users');
      exit;
    }

    // Afficher le formulaire de création d'un utilisateur
    require_once(__DIR__ . '/../Views/admin/userCrud/create.php');
  }



  public function manage_users()
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

}
