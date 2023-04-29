<?php

namespace Controllers;

use Models\User;
use PDO;

class UserController
{
    public function index()
    {
        // Récupération de tous les utilisateurs
        $user = User::getAll();

        // Affichage de la vue admin/user/index.php avec les données récupérées
        require __DIR__ . '/../Views/admin/user/index.php';
    }

    public function create()
    {
        // Affichage de la vue admin/user/create.php pour créer un nouvel utilisateur
        require __DIR__ . '/../Views/admin/user/create.php';
    }

    public function store()
    {
        // Récupération des données du formulaire de création d'utilisateur
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Création du nouvel utilisateur
        $user = new User($name, $email, $password);
        $user->save();

        // Redirection vers la page d'administration des utilisateurs
        header('Location: /admin/user');
    }

    public function edit($id)
    {
        // Récupération de l'utilisateur correspondant à l'identifiant $id
        $user = User::getById($id);

        // Affichage de la vue admin/user/edit.php avec les données récupérées
        require __DIR__ . '/../views/admin/user/edit.php';
    }

    public function update($id)
    {
        // Récupération des données du formulaire d'édition d'utilisateur
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Récupération de l'utilisateur correspondant à l'identifiant $id
        $user = User::getById($id);

        // Mise à jour des données de l'utilisateur
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setUpdatedAt(date('Y-m-d H:i:s'));
        $user->save();

        // Redirection vers la page d'administration des utilisateurs
        header('Location: /admin/index');
    }

    public function delete($id)
    {
        // Récupération de l'utilisateur correspondant à l'identifiant $id
        $user = User::getById($id);

        // Suppression de l'utilisateur
        $user->delete();

        // Redirection vers la page d'administration des utilisateurs
        header('Location: /admin/user');
    }


    public function login()
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Inclure le fichier de configuration et le fichier de connexion à la base de données
        require_once __DIR__ . '/../config/config.php';
        require_once __DIR__ . '/../config/database.php';

        // Récupérer les informations d'identification du formulaire
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Requête pour trouver l'utilisateur par e-mail
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            // Stocker les informations utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            // Rediriger l'utilisateur vers la page d'accueil
            header('Location: ' . BASE_URL . 'home');
            exit;
        } else {
            // Message d'erreur si les informations d'identification sont incorrectes
            $error_message = "E-mail ou mot de passe incorrect.";
            require_once __DIR__ . '/../views/login.php';
        }
    } else {
        require_once __DIR__ . '/../views/login.php';
    }
}
    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/');
    }
}
