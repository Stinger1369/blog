<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../controllers/AdminController.php';
?>

<body class="bg-gray-100">

  <h1 class="text-4xl font-bold mb-8 text-center">Édition de post</h1>

  <div class="container mx-auto max-w-lg">
    <form method="POST" action="<?php echo BASE_URL; ?>/admin/edit-post?id=<?php echo $post->getId(); ?>">

      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>">
      </div>

      <div class="mb-6">
        <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="body" name="body" rows="5"><?php echo htmlspecialchars($body); ?></textarea>
      </div>

      <div class="flex justify-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Save
        </button>
      </div>

    </form>
  </div>

</body>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>