<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h1>Dashboard</h1>

<div class="actions">
  <a href="<?php echo BASE_URL; ?>/views/admin/add-post.php" class="btn btn-primary">Add Post</a>
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
            <a href="/blog/views/admin/edit-post.php?id=<?php echo $post->getId(); ?>" class="btn btn-primary">Edit</a>
            <form method="POST" action="<?php echo BASE_URL; ?>/admin/posts/<?php echo $post->getId(); ?>/delete" style="display: inline-block;">
              <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
              <form method="POST" action="/blog/Views/admin/delete-post.php" style="display: inline-block;">
                <input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else : ?>
  <p>No posts found.</p>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>