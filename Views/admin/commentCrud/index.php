<!-- Views/admin/commentCrud/index.php -->

<?php require_once __DIR__ . '/../../partials/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="mt-4">Gestion des commentaires</h1>

      <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
          <?php echo $_SESSION['success'];
          unset($_SESSION['success']); ?>
        </div>
      <?php endif; ?>

      <a href="/admin/comments/create" class="btn btn-primary mb-3">Ajouter un commentaire</a>

      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Post ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Contenu</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comments as $comment) : ?>
            <tr>
              <td><?php echo $comment->getId(); ?></td>
              <td><?php echo $comment->getPostId(); ?></td>

              <td><?php echo $comment->getName(); ?></td>
              <td><?php echo $comment->getEmail(); ?></td>
              <td><?php echo $comment->getBody(); ?></td>
              <td>
                <a href="<?php echo BASE_URL; ?>/admin/editcomment/<?php echo $comment->getId(); ?>" class="btn btn-sm btn-warning">Modifier</a>
                <form action="/blog/admin/comments/<?php echo $comment->getId(); ?>/delete" method="post" class="d-inline">
                  <input type="hidden" name="id" value="<?php echo $comment->getId(); ?>">
                  <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>