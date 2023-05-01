<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../controllers/PostController.php';

$postController = new \Controllers\PostController();
$posts = $postController->getAllPosts();
?>
<h1>Dashboard</h1>

<div class="actions">
  <a href="<?php echo BASE_URL; ?>/admin/add-post" class="btn btn-primary">Add Post</a>
  <a href="<?php echo BASE_URL; ?>/admin/manage-users" class="btn btn-primary">manage-users</a>


</div>


<?php if (isset($posts)) : ?>
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) : ?>
        <tr>
          <td><?php echo $post->getTitle(); ?></td>
          <td><?php echo $post->getCreated_At(); ?></td>
          <td><?php echo $post->getUpdated_At(); ?></td>
          <td>



            <a href="<?php echo BASE_URL; ?>/admin/edit-post?id=<?php echo $post->getId(); ?>" class="btn btn-warning">Modifier</a>


            <form id="delete-form" method="POST" action="<?php echo BASE_URL; ?>/admin/delete-post" style="display: inline-block;">
              <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
              <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
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
  function confirmDelete() {
    var confirmed = confirm("Confirmer la suppression ?");
    if (confirmed) {
      document.getElementById("delete-form").submit();
    }
    return confirmed;
  }
</script>


<?php require_once __DIR__ . '/../partials/footer.php'; ?>