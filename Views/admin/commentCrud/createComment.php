<!-- Views/admin/commentCrud/createComment.php -->

<?php require_once __DIR__ . '/../../partials/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="mt-4">Ajouter un nouveau commentaire</h1>

      <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger">
          <?php echo $_SESSION['error'];
          unset($_SESSION['error']); ?>
        </div>
      <?php endif; ?>

      <form action="/admin/comments/store" method="post">
        <div class="form-group">
          <label for="post_id">ID du post</label>
          <input type="text" name="post_id" id="post_id" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="name">Nom</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="body">Contenu</label>
          <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
        </div>
        <input type="submit" value="Enregistrer" class="btn btn-primary">
      </form>

    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>