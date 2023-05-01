  // public function edit($id)
  // {
  // // Récupération du post correspondant à l'identifiant $id
  // $post = Post::getById($id);
  // if (!$post) {
  // header('Location: ' . BASE_URL . '/admin');
  // exit;
  // }

  // // Récupération des données du post
  // // Récupération des données du post
  // $title = !empty($_POST['title']) ? $_POST['title'] : $post->getTitle();
  // $body = !empty($_POST['body']) ? $_POST['body'] : $post->getBody();


  // // Affichage de la vue admin/posts/edit.php avec les données récupérées
  // require __DIR__ . '/../views/admin/edit-post.php';
  // }
  // public function update($id)
  // {
  // // Vérification de la méthode de requête HTTP
  // if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  // header('Location: ' . BASE_URL . '/admin/' . $id . '/edit-post');
  // exit;
  // }

  // // Récupération des données du formulaire d'édition de post
  // $title = $_POST['title'];
  // $body = $_POST['body'];

  // // Récupération du post correspondant à l'identifiant $id
  // $post = Post::getById($id);
  // if (!$post) {
  // header('Location: ' . BASE_URL . '/admin');
  // exit;
  // }

  // // Mise à jour des données du post
  // $post->setTitle($title);
  // $post->setBody($body);
  // $post->setUpdatedAt(date('Y-m-d H:i:s'));
  // $post->save();

  // // Redirection vers la page d'administration des posts
  // header('Location: ' . BASE_URL . '/admin');
  // exit;
  //