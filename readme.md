## blog/ ##
│
├── config/
│   ├── config.php
│   └── database.php
│
├── controllers/
│   ├── HomeController.php
│   ├── PostController.php
│   ├── CommentController.php
│   └── UserController.php
│
├── models/
│   ├── Post.php
│   ├── Comment.php
│   └── User.php
│
├── views/
│   ├── home/
│   │   ├── index.php
│   │   └── show.php
│   │
│   ├── admin/
│   │   ├── index.php
│   │   ├── edit-post.php
│   │   ├── add-post.php
│   │   └── manage-users.php
│   │
│   ├── partials/
│   │   ├── header.php
│   │   └── footer.php
│   │
│   ├── login.php
│   └── register.php
│
├── public/
│   ├── css/
│   │   └── style.css
│   │
│   ├── js/
│   │   └── main.js
│   │
│   └── .htaccess
│
├── .htaccess
└── index.php

F:.
├───Config
├───Controllers
├───Core
├───Models
├───public
│   ├───css
│   └───js
├───src
├───vendor
│   ├───altorouter
│   │   └───altorouter
│   └───composer
└───Views
    ├───admin
    ├───errors
    ├───home
    └───partials
PS F:\xampp\htdocs\blog> tree /F /A | findstr /v /c:"\\vendor\\"
Structure du dossier pour le volume Formation
Le num?ro de s?rie du volume est DFC9-82D8
F:.
|   .htaccess
|   composer.json
|   composer.lock
|   index.php
|   password_hash.php
|   readme.md
|
+---Config
|       config.php
|       Database.php
|       ECF.sql
|
+---Controllers
|       AdminController.php
|       CommentController.php
|       ErrorController.php
|       HomeController.php
|       LoginController.php
|       PostController.php
|       UserController.php
|
+---Core
|       Router.php
|
+---Models
|       Comment.php
|       Model.php
|       Post.php
|       User.php
|
+---public
|   |   test.php
|   |
|   +---css
|   |       style.css
|   |
|   \---js
|           main.js
|
+---src
+---vendor
|   |   autoload.php
|   |
|   +---altorouter
|   |   \---altorouter
|   |           AltoRouter.php
|   |           composer.json
|   |           LICENSE.md
|   |           phpcs.xml
|   |           README.md
|   |
|   \---composer
|           autoload_classmap.php
|           autoload_namespaces.php
|           autoload_psr4.php
|           autoload_real.php
|           autoload_static.php
|           ClassLoader.php
|           installed.json
|           installed.php
|           InstalledVersions.php
|           LICENSE
|           platform_check.php
|
\---Views
    |   login.php
    |   register.php
    |
    +---admin
    |       add-post.php
    |       edit-post.php
    |       index.php
    |       manage-users.php
    |       save-post.php
    |
    +---errors
    |       404.php
    |
    +---home
    |       index.php
    |       show.php
    |
    \---partials
            footer.php
            header.php


tree /F /A | findstr /v /c:"\\vendor\\"