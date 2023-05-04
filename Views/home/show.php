<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main class="container mx-auto px-4">
  <h1 class="text-4xl font-bold mb-8"><?= $post->getTitle() ?></h1>
  <p class="text-sm text-gray-600 mb-4">By <?= $post->getUser()->getName() ?> on <?= $post->getCreated_At() ?> Updated on : <?= $post->getupdated_At() ?> by : <?= $post->getUser()->getName() ?></p>
  <div class="post-content mb-8">
    <p><?= $post->getBody() ?></p>
  </div>

  <h2 class="text-3xl font-semibold mb-4">Comments</h2>
  <div class="comments">
    <?php foreach ($comments as $comment) : ?>
      <div class="comment mb-4">
        <p><?= $comment->getBody() ?></p>
        <p class="text-sm text-gray-600 mb-4"> By <?= $post->getUser()->getName() ?> on <?= $post->getcreated_At() ?> Updated on : <?= $post->getupdated_At() ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (isset($_SESSION['user_id'])) : ?>
    <h2 class="text-3xl font-semibold mb-4">Ajouter un commentaire</h2>
    <div class="comment-form mt-4">
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

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>