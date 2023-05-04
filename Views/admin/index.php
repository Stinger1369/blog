<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../controllers/PostController.php';

$postController = new \Controllers\PostController();
$posts = $postController->getAllPosts();
?>

<h1 class="text-4xl font-bold mb-8">Dashboard</h1>

<div class="flex justify-between items-center mb-8">
  <a href="<?php echo BASE_URL; ?>/admin/add-post" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Add Post
  </a>
  <a href="<?php echo BASE_URL; ?>/admin/commentCrud/index" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Manage Comment
  </a>
  <a href="<?php echo BASE_URL; ?>/admin/manage-users" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Manage Users
  </a>
</div>

<?php if (isset($posts)) : ?>
  <table class="table w-full">
    <thead>
      <tr>
        <th class="px-4 py-2">Title</th>
        <th class="px-4 py-2">Created At</th>
        <th class="px-4 py-2">Updated At</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) : ?>
        <tr>
          <td class="border px-4 py-2"><?php echo $post->getTitle(); ?></td>
          <td class="border px-4 py-2"><?php echo $post->getCreated_At(); ?></td>
          <td class="border px-4 py-2"><?php echo $post->getUpdated_At(); ?></td>
          <td class="border px-4 py-2">

            <a href="<?php echo BASE_URL; ?>/admin/edit-post?id=<?php echo $post->getId(); ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
              Modifier
            </a>

            <form id="delete-form-<?php echo $post->getId(); ?>" method="POST" action="<?php echo BASE_URL; ?>/admin/delete-post" style="display: inline-block;">
              <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
              <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirmDelete(<?php echo $post->getId(); ?>)">
                Delete
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else : ?>
  <p>No posts found.</p>
<?php endif; ?>

<script>
  function confirmDelete(postId) {
    var confirmed = confirm("Confirmer la suppression ?");
    if (confirmed) {
      document.getElementById("delete-form-" + postId).submit();
    }
    return confirmed;
  }
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>