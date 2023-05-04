<?php
require_once __DIR__ . '/../../partials/header.php';
?>

<div class="flex justify-center items-center h-screen">
  <form action="<?php echo BASE_URL; ?>/admin/commentCrud/updateComment?id=<?php echo $comment->getId(); ?>" method="post" class="w-1/2 max-w-lg">
    <h1 class="text-3xl font-bold mb-6">Modifier le commentaire</h1>
    <div class="mb-4">
      <label for="name" class="block font-medium text-gray-700">Nom:</label>
      <input type="text" name="name" id="name" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="<?php echo htmlspecialchars($comment->getName()); ?>">
    </div>
    <div class="mb-4">
      <label for="email" class="block font-medium text-gray-700">Email:</label>
      <input type="email" name="email" id="email" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="<?php echo htmlspecialchars($comment->getEmail()); ?>">
    </div>
    <div class="mb-4">
      <label for="body" class="block font-medium text-gray-700">Contenu du commentaire:</label>
      <textarea name="body" id="body" cols="30" rows="10" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"><?php echo htmlspecialchars($comment->getBody()); ?></textarea>
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Mettre à jour le commentaire</button>
  </form>
</div>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>