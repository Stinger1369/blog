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
        <p class="text-sm text-gray-600 mb-4">By <?= $post->getUser()->getName() ?> on <?= $post->getcreated_At() ?> Updated on : <?= $post->getupdated_At() ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>