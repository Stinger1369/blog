<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
require_once __DIR__ . '/../partials/header.php';
?>

<body>

  <main class="container mx-auto px-4 w-1/2">
    <h1 class="text-4xl font-bold mb-8">Blog posts</h1>
    <div class="pagination flex flex-wrap items-center justify-center m-8">
      <?php if ($page > 1) : ?>
        <a href="<?= BASE_URL ?>/?page=<?= $page - 1 ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Précédent
        </a>
      <?php endif; ?>
      <span class="mx-2">&nbsp;</span>
      <?php if ($page < $totalPages) : ?>
        <a href="<?= BASE_URL ?>/?page=<?= $page + 1 ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Suivant
        </a>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <?php foreach ($posts as $post) : ?>
        <article class="bg-white shadow-md rounded p-6 mb-8 max-w-md mx-auto">
          <h2 class="text-2xl font-semibold mb-4"><a href="<?= BASE_URL ?>/posts/<?= $post->getId() ?>"><?= $post->getTitle() ?></a></h2>
          <div class="post-content">
            <p class="mb-4"><?= substr($post->getBody(), 0, strlen($post->getBody()) / 2) ?></p>
            <p class="mb-4 "><?= substr($post->getBody(), strlen($post->getBody()) / 2) ?></p>
          </div>
          <?php $user = $post->getUser(); ?>
          <?php if ($user !== null) : ?>
            <p class="text-sm text-gray-600 mb-4">By <?= $user->getName() ?> on <?= $post->getCreated_At() ?></p>

            <div class="post-comments hidden" data-post-id="<?= $post->getId() ?>">
              <?php $comments = $post->getComments(); ?>
              <?php if (count($comments) > 0) : ?>
                <h3>Comments:</h3>
                <ul>
                  <?php foreach ($comments as $comment) : ?>
                    <li><?= $comment->getBody() ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php else : ?>
                <p>No comments yet</p>
              <?php endif; ?>
            </div>
            <a href="<?= BASE_URL ?>/posts/<?= $post->getId() ?>" class="text-blue-500 hover:text-blue-700 ">Voir l'article complet</a>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded show-comments-button">Afficher Plus</button>
            <button class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden hide-comments-button">Cacher</button>
            <?php if (isset($_SESSION['user_id'])) : ?>
              <a href="<?= BASE_URL ?>/posts/<?= $post->getId() ?>" text-gray-600 font-bold py-2 px-4 rounded mt-4">
                Commenter
              </a>

              <div data-post-id="<?= $post->getId() ?>" class="comment-form hidden mt-4">
                <form action="<?= BASE_URL ?>/add-comment" method="POST">
                  <input type="hidden" name="post_id" value="<?= $post->getId() ?>">
                  <label for="email" class="block text-sm font-bold mb-2">Email:</label>
                  <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= $_SESSION['user_name'] ?>" readonly>
                  <label for="body" class="block text-sm font-bold mb-2">Commentaire:</label>
                  <textarea name="body" id="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" required></textarea>
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter</button>
                </form>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>

    </div>

  </main>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const showCommentsButtons = document.querySelectorAll('.show-comments-button');
      const hideCommentsButtons = document.querySelectorAll('.hide-comments-button');
      const commentButtons = document.querySelectorAll('.comment-button');
      const commentForms = document.querySelectorAll('.comment-form');

      // Écouteur d'événement pour le bouton "Afficher les commentaires"
      showCommentsButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const commentsDiv = button.closest('article').querySelector('.post-comments');
          commentsDiv.classList.remove('hidden');
          button.classList.add('hidden');
          button.nextElementSibling.classList.remove('hidden');
        });
      });

      // Écouteur d'événement pour le bouton "Cacher les commentaires"
      hideCommentsButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const commentsDiv = button.closest('article').querySelector('.post-comments');
          commentsDiv.classList.add('hidden');
          button.classList.add('hidden');
          button.previousElementSibling.classList.remove('hidden');
        });
      });

      // Écouteur d'événement pour la soumission des formulaires de commentaire
      commentForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
          event.preventDefault();

          const postId = form.querySelector('input[name="post_id"]').value;
          const email = form.querySelector('input[name="email"]').value;
          const body = form.querySelector('textarea[name="body"]').value;

          const formData = new FormData();
          formData.append('post_id', postId);
          formData.append('email', email);
          formData.append('body', body);

          fetch('<?= BASE_URL ?>/add-comment', {
              method: 'POST',
              body: formData,
            })
            .then((response) => {
              if (response.ok) {
                return response.text();
              } else {
                throw new Error('Erreur lors de l\'ajout du commentaire');
              }
            })
            .then((data) => {
              const commentsDiv = document.querySelector(`.post-comments[data-post-id="${postId}"]`);
              const newComment = document.createElement('li');
              newComment.textContent = body;
              commentsDiv.querySelector('ul').appendChild(newComment);

              form.querySelector('textarea[name="body"]').value = '';
              form.classList.add('hidden');
            })
            .catch((error) => {
              console.error('Erreur:', error);
            });
        });
      });
    });
  </script>

</body>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>