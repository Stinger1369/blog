<?php require_once __DIR__ . '/../partials/header.php';
 //echo 'Appel de la vue home/index.php';
 ?>
<main class="container">
  <h1>Blog posts</h1>

  <?php foreach ($posts as $post) : ?>
    <article>
      <h2><a href="<?= BASE_URL ?>/posts/<?= $post->getId() ?>"><?= $post->getTitle() ?></a></h2>
      <p><?= $post->getBody() ?></p>
      <?php $user = $post->getUser(); ?>
      <?php if ($user !== null) : ?>
        <p class="small text-muted">By <?= $user->getName() ?> on <?= $post->getCreatedAt() ?></p>
      <?php endif; ?>
    </article>
  <?php endforeach; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>