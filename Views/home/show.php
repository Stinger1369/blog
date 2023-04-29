<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <article>
    <h1><?= $post->getTitle() ?></h1>
    <p><?= $post->getBody() ?></p>
    <?php $user = $post->getUser(); ?>
    <?php if ($user !== null) : ?>
      <p class="small text-muted">By <?= $user->getName() ?> on <?= $post->getCreatedAt() ?></p>
    <?php endif; ?>
  </article>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>