<?php

namespace Controllers;

use Models\User;



class LoginController
{
  public function index()
  {
    // Afficher la page de connexion
    require_once(__DIR__ . '/../Views/login.php');
  }

  public function login()
  {
    // Gérer la connexion de l'utilisateur ici
    if (isset($_POST['email']) && isset($_POST['password'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = new User();
      $loggedInUser = $user->authenticate($email, $password);

      if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser->getId();
        $_SESSION['user_role'] = $loggedInUser->getRole();
        $_SESSION['success_message'] = 'Vous êtes connecté avec succès!';
        $_SESSION['user_name'] = $loggedInUser->getName(); // Assurez-vous que la propriété "name" est définie ici
        header('Location: ' . BASE_URL . '/');
        exit;
      }
       else {
        // Échec de l'authentification
        $_SESSION['error_message'] = 'Email ou mot de passe incorrect.';
        header('Location: ' . BASE_URL . '/login');
        exit;
      }
    } else {
      header('Location: ' . BASE_URL . '/login');
    }
  }
  public function logout()
  {
    session_destroy();
    header('Location: ' . BASE_URL . '/login');
}
}