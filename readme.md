
ECF PHP

Cahier des charges
Maintenant que nous avons vu ensemble les bases du langage PHP je vous propose
de mettre en pratique ce que l'on a vu depuis le début de cette formation à travers un
exemple concret. Pour cet exemple nous allons créer un blog. Sur ce blog il y aura
des postes avec des commentaires écrit par des utilisateurs.
Dans cette exemple nous aurons plusieurs pages :
 La page d'accueil (accessible via l'url /) permettra de voir les 12 derniers
postes et permettra de remonter en arrière avec une pagination simple (2
boutons, suivant et précédent permettront de naviguer entre les pages).
 Chaque article sera présenté sous forme de carte avec un titre, la date de
publication, son auteur, une description courte et un lien permettant de voir
l'article dans sa totalité.

 Les postes seront cliquables et permettront de voir le poste ainsi que les
commentaires associés à ce poste.

Espace d'administration
Afin de pouvoir gérer le site il faudra aussi concevoir un espace d'administration qui
permettra de gérer les postes. Cet espace d'administration devra être protégé par un
système d'identification (email ou login & mot de passe). Chaque utilisateur reçoit un
rôle (« USER » - « ADMIN »), Nous donnerons accès à la page d’administration
uniquement si l’utilisateur a le rôle d’administrateur.
 Vous vérifiez en amont l’accessibilité à l’url « /admin », si un utilisateur non
connecter essai l’url « /admin » il devra être redirigé vers « /login »
 Une première page permettra de lister les postes sous forme de tableau.
Chaque ligne comportera 2 boutons permettant respectivement de modifier et
de supprimer un poste.
 La page d'édition permettra de changer le titre et le contenu associées au
poste.
 Lors de la modification, nous devrons mettre à jour la date du poste.
 Sur la page listing de poste, un bouton permettra d'ajouter un nouveau poste.
Style
Pour le style et la mise en page de notre application on se reposera sur Bootstrap

Bonus

 Dans la vue du poste nous afficherons uniquement 2 commentaires associés
au poste et on rajoutera un bouton voir plus qui demande, par une requête
Ajax, les 2 commentaires suivants.
 Ajouter le même système de modifications et de suppression pour les
commentaires
 Ajouter une administration pour pouvoir changer le rôle d’un utilisateur
(« USER », « ADMIN »)
 Mettre en place le chiffrement des mots de passe pour les utilisateurs et
modifier la vérification dans la partie « /login »


blog
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


tree /F /A | findstr /v /c:"\\vendor\\" /c:"\\node_modules\\"
 Xdebug