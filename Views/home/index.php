<?php require_once __DIR__ . '/../partials/header.php'; ?>

<body>
  <main class="container mx-auto px-4 w-1/2">
    <h1 class="text-4xl font-bold mb-8">Blog posts</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      <?php foreach ($posts as $post) : ?>
        <article class="bg-white shadow-md rounded p-6 mb-8 max-w-md mx-auto">
          <h2 class="text-2xl font-semibold mb-4"><a href="<?= BASE_URL ?>/posts/<?= $post->getId() ?>"><?= $post->getTitle() ?></a></h2>
          <div class="post-content">
            <p class="mb-4"><?= substr($post->getBody(), 0, strlen($post->getBody()) / 2) ?></p>
            <p class="mb-4 hidden"><?= substr($post->getBody(), strlen($post->getBody()) / 2) ?></p>
          </div>
          <?php $user = $post->getUser(); ?>
          <?php if ($user !== null) : ?>
            <p class="text-sm text-gray-600 mb-4">By <?= $user->getName() ?> on <?= $post->getCreated_At() ?></p>
          <?php endif; ?>

          <button class="show-more-content bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Voir plus
          </button>
          <button class="hide-content bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4 hidden">
            Cacher
          </button>
        </article>
      <?php endforeach; ?>
    </div>
  </main>

  <script>
    document.querySelectorAll('.show-more-content').forEach(button => {
      button.addEventListener('click', event => {
        const content = event.target.parentElement.querySelector('.post-content');
        content.querySelector('p.hidden').classList.remove('hidden');
        event.target.style.display = 'none';
        event.target.nextElementSibling.style.display = 'inline-block';
      });
    });

    document.querySelectorAll('.hide-content').forEach(button => {
      button.addEventListener('click', event => {
        const content = event.target.parentElement.querySelector('.post-content');
        content.querySelector('p:not(.hidden)').nextElementSibling.classList.add('hidden');
        event.target.style.display = 'none';
        event.target.previousElementSibling.style.display = 'inline-block';
      });
    });
  </script>
</body>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>



<!--<main class="container mx-auto px-4 w-1/2">
  <h1 class="text-4xl font-bold mb-8">Blog posts</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    <?php foreach ($posts as $post) : ?>
      <article class="bg-white shadow-md rounded p-6 mb-8 max-w-md mx-auto flex flex-col justify-end">
        <h2 class="text-2xl font-semibold mb-4"><a href="<?= BASE_URL ?>/posts/<?= $post->getId() ?>"><?= $post->getTitle() ?></a></h2>
        <div class="post-content">
          <p class="mb-4"><?= substr($post->getBody(), 0, strlen($post->getBody()) / 2) ?></p>
          <p class="mb-4 hidden"><?= substr($post->getBody(), strlen($post->getBody()) / 2) ?></p>
        </div>
        <?php $user = $post->getUser(); ?>
        <?php if ($user !== null) : ?>
          <p class="text-sm text-gray-600 mb-4">By <?= $user->getName() ?> on <?= $post->getCreated_At() ?></p>
        <?php endif; ?>

        <button class="show-more-content bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-auto">
          Voir plus
        </button>
        <button class="hide-content bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-auto hidden">
          Cacher
        </button>
      </article>
    <?php endforeach; ?>
  </div>
</main>-->