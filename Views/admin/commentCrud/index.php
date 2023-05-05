<?php
require_once __DIR__ . '/../../partials/header.php';
?>

<div class="container mx-auto px-4">
  <div class="grid grid-cols-1">
    <div class="col-span-1">
      <h1 class="mt-4 text-2xl font-semibold">Gestion des commentaires</h1>

      <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success bg-green-500 text-white px-4 py-2 rounded-lg">
          <?php echo $_SESSION['success'];
          unset($_SESSION['success']); ?>
        </div>
      <?php endif; ?>

      <table class="table-auto w-full mt-8">
        <thead>
          <tr>
            <th class="px-4 py-2 border border-gray-300">ID</th>
            <th class="px-4 py-2 border border-gray-300">Post ID</th>
            <th class="px-4 py-2 border border-gray-300">Contenu</th>
            <th class="px-4 py-2 border border-gray-300">Email</th>
            <th class="px-4 py-2 border border-gray-300">created_at</th>
            <th class="px-4 py-2 border border-gray-300">Updated_at</th>
            <th class="px-4 py-2 border border-gray-300">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comments as $comment) : ?>
            <tr>
              <td class="px-4 py-2 border border-gray-300"><?php echo $comment->getId(); ?></td>
              <td class="px-4 py-2 border border-gray-300"><?php echo $comment->getPostId(); ?></td>
              <td class="px-4 py-2 border border-gray-300"><?php echo $comment->getBody(); ?></td>
              <td class="px-4 py-2 border border-gray-300"><?php echo $comment->getEmail(); ?></td>
              <td class="px-4 py-2 border border-gray-300"><?php echo $comment->getcreatedAt(); ?></td>
              <td class="px-4 py-2 border border-gray-300"><?= $comment->getupdated_at() ?></td>
              <td class="px-4 py-2 border border-gray-300 flex justify-around">

                <a href="<?php echo BASE_URL; ?>/admin/commentCrud/editcomment/<?php echo $comment->getId(); ?>" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
                  Modifier
                </a>

                <form id="delete-comment-form-<?php echo $comment->getId(); ?>" method="POST" action="<?php echo BASE_URL; ?>/admin/commentCrud/delete/<?php echo $comment->getId(); ?>" class="inline-block">
                  <input type="hidden" name="id" value="<?php echo $comment->getId(); ?>">
                  <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg" onclick="return confirmDelete(<?php echo $comment->getId(); ?>)">
                    Supprimer
                  </button>
                </form>

              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  function confirmDelete(commentId) {
    const result = confirm('Voulez-vous vraiment supprimer ce commentaire ?');
    if (result) {
      document.getElementById('delete-comment-form-' + commentId).submit();
    }
    return false;
  }
</script>
<?php require_once __DIR__ . '/../../partials/footer.php'; ?>