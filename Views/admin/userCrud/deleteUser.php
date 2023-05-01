<?php
require_once '../../../vendor/autoload.php';

use Models\User;

// Vérifie si l'identifiant utilisateur est fourni
if (isset($_GET['id'])) {
  $user = User::getById($_GET['id']);

  // Si l'utilisateur existe, supprimez-le
  if ($user) {
    $user->delete();
  }
}

// Rediriger l'utilisateur vers la page de gestion des utilisateurs
header('Location: /admin/manage-users.php');
exit;
