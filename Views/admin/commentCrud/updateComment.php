<?php require_once __DIR__ . '/../../partials/admin/header.php'; ?>

<div class="container mt-4">
  <h2 class="mb-4">Modifier le commentaire</h2>

  <?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger">
      <?php echo $_SESSION['error'];
      unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <form method="post" action="/admin/comments/update">
    <input type="hidden" name="id" value="<?php echo $comment->id; ?>">
    <div class="form-group">
      <label for="name">Nom</label>
      <input type="text" name="name" id="name" class="form-control" value="<?php echo $comment->getName(); ?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="<?php echo $comment->getEmail(); ?>" required>
    </div>
    <div class="form-group">
      <label for="body">Commentaire</label>
      <textarea name="body" id="body" class="form-control" rows="5" required><?php echo $comment->getBody(); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour le commentaire</button>
    <a href="/admin/posts/<?php echo $comment->getPostId(); ?>" class="btn btn-secondary">Annuler</a>
  </form>
</div>

<?php require_once __DIR__ . '/../../partials/admin/footer.php'; ?>