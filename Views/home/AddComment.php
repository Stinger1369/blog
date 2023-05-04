<?php if (isset($_SESSION['user_id'])) : ?>
  <button data-post-id="<?= $post->getId() ?>" class="comment-button bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
    Commenter
  </button>

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