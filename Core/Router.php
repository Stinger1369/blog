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
    //$this->router->map('GET', '/posts', 'Controllers\PostController#index');
    $this->router->map('GET', '/posts/[i:id]', 'Controllers\PostController#show');

    //$this->router->map('GET', '/posts/[i:id]/', 'Controllers\PostController#show');
    $this->router->map('GET', '/admin/edit-post', 'Controllers\PostController#edit');

    $this->router->map('GET','/comments/loadMore/:postId/:offset', 'CommentController#loadMore');


    $this->router->map('POST', '/admin/edit-post', 'Controllers\PostController#update');

    $this->router->map('POST', '/posts/create/', 'Controllers\PostController#create');
    $this->router->map('POST', '/admin/delete-post', 'Controllers\PostController#delete');

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

    $this->router->map('POST', '/admin/userCrud/userUpdate/[:id]', 'Controllers\AdminController#editUser');
    $this->router->map('GET', '/admin/userCrud/userUpdate/[:id]', 'Controllers\AdminController#editUser');
    //$this->router->map('POST', '/admin/users/[i:id]/delete', 'Controllers\AdminController#deleteUser');
    $this->router->map('POST', '/admin/userCrud/delete/[i:id]', 'Controllers\AdminController#deleteUser');

    $this->router->map('GET', '/admin/manage-users', 'Controllers\AdminController#manage_users');

    //$this->router->map('GET|POST', '/admin/userCrud/create', 'Controllers\AdminController#add_user');
    $this->router->map('GET|POST', '/admin/userCrud/create', 'Controllers\AdminController#addUser');




    $this->router->map('POST', '/admin/save-post', 'Controllers\PostController#savePostAction');
    $this->router->map('GET', '/admin/add-post', 'Controllers\PostController#addPost');

    //$this->router->map('GET|POST', '/admin/userCrud/register', 'UserController#register');

    $this->router->map('GET','/posts/(\d+)/comments/load-more/(\d+)', 'CommentController#loadMoreComments');


    //Comment
    $this->router->map('GET', '/admin/commentCrud/index', 'Controllers\CommentController#index');
    $this->router->map('GET', '/admin/commentCrud', 'Controllers\CommentController#adminIndex');
    $this->router->map('GET', '/admin/commentCrud/create', 'Controllers\CommentController#adminCreate');
    $this->router->map('POST', '/admin/commentCrud/store', 'Controllers\CommentController#store');

    $this->router->map('GET', '/admin/editcomment/[i:id]', 'Controllers\CommentController#edit', 'edit_comment');
    $this->router->map('GET', '/admin/commentCrud/index/[i:post_id]', 'Controllers\CommentController#indexByPostId');

    $this->router->map('POST', '/admin/commentCrud/update', 'Controllers\CommentController#update');
    $this->router->map('GET', '/admin/commentCrud/[i:id]/delete', 'Controllers\CommentController#destroy');

    $this->router->map('POST', '/add-comment', 'Controllers\CommentController#addComment');


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
   // echo '</pre>';

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
