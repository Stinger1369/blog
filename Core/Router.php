<?php

namespace Core;

use AltoRouter;
use Controllers\ErrorController;

class Router
{
  private $router;

  public function __construct()
  {
    $this->router = new AltoRouter();
    $this->router->setBasePath(BASE_URL);

    // Accueil
    $this->router->map('GET', '/', 'Controllers\HomeController#index');

    // Articles
    $this->router->map('GET', '/posts', 'Controllers\PostController#index');
    $this->router->map('GET', '/posts/[i:id]', 'Controllers\PostController#show');
    $this->router->map('GET', '/posts/[i:id]/edit', 'Controllers\PostController#edit');
    $this->router->map('POST', '/posts/[i:id]/update', 'Controllers\PostController#update');
    $this->router->map('GET', '/posts/add', 'Controllers\PostController#add');
    $this->router->map('POST', '/posts/create', 'Controllers\PostController#create');
    $this->router->map('POST', '/admin/posts/[i:id]/delete', 'Controllers\PostController#delete');

    // Commentaires
    $this->router->map('POST', '/comments/create', 'Controllers\CommentController#create');

    // Utilisateurs
    $this->router->map('GET', '/login', 'Controllers\LoginController#index');
    $this->router->map('POST', '/login', 'Controllers\LoginController#login');
    $this->router->map('GET', '/logout', 'Controllers\UserController#logout');
    $this->router->map('GET', '/register', 'Controllers\UserController#register');

    // Admin
    $this->router->map('GET', '/admin', 'Controllers\AdminController#index');
    $this->router->map('GET', '/admin/users', 'Controllers\AdminController#users');
    $this->router->map('GET', '/admin/users/[i:id]/edit', 'Controllers\AdminController#editUser');
    $this->router->map('POST', '/admin/users/[i:id]/update', 'Controllers\AdminController#updateUser');
    $this->router->map('POST', '/admin/users/[i:id]/delete', 'Controllers\AdminController#deleteUser');
    $this->router->map('POST', '/admin/save-post', 'Controllers\AdminController#savePostAction');


    // Erreur 404
    //$this->router->map('GET', '/404', 'Controllers\ErrorController#notFound');

    // On inclut les contrôleurs
    require_once(__DIR__ . '/../Controllers/HomeController.php');
    require_once(__DIR__ . '/../Controllers/PostController.php');
    require_once(__DIR__ . '/../Controllers/CommentController.php');
    require_once(__DIR__ . '/../Controllers/UserController.php');
    require_once(__DIR__ . '/../Controllers/AdminController.php');
    require_once(__DIR__ . '/../Controllers/ErrorController.php');
    require_once(__DIR__ . '/../Controllers/LoginController.php');
    require_once(__DIR__ . '/../Models/Post.php');
    require_once(__DIR__ . '/../Models/User.php');
    require_once(__DIR__ . '/../Models/Comment.php');
  }

  public function run()
  {
    $match = $this->router->match();

    // Ajoutez ces lignes pour déboguer :
    //echo '<pre>';
    //var_dump($match);
    //echo '</pre>';

    if ($match !== false) {
      list($controllerName, $methodName) = explode('#', $match['target']);

      // Modification ici :
      $controllerName = $controllerName;

      // Supprimez la ligne 'echo' suivante :
      // echo 'Route trouvée : ';
      // echo 'Contrôleur: ' . $controllerName . ' | Méthode: ' . $methodName . '<br>';

      $controller = new $controllerName();
      $params = $match['params'];
      $controller->$methodName($params);
    } else {
      header("HTTP/1.0 404 Not Found");
      $controller = new ErrorController();
      $controller->notFound();
    }
  }


}
