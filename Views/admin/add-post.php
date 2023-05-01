<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../controllers/AdminController.php';
?>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <?php require_once __DIR__ . '/../../config/config.php'; ?>

  <main class="flex-grow">
    <h1 class="text-4xl font-bold mb-8">Add Post</h1>
    <form action="<?php echo BASE_URL ?>/admin/save-post" method="post" class="w-1/2 mx-auto">
      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
        <input type="text" name="title" id="title" class="w-full rounded-lg border-gray-300">
      </div>
      <div class="mb-4">
        <label for="body" class="block text-gray-700 font-bold mb-2">Body:</label>
        <textarea name="body" id="body" class="w-full rounded-lg border-gray-300"></textarea>
      </div>
      <div class="flex justify-center">
        <input type="submit" value="Save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      </div>
    </form>
  </main>

  <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>