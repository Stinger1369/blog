<?php require_once __DIR__ . '/../../partials/header.php'; ?>
<h1>Modifier le commentaire</h1>
<form action="<?php echo BASE_URL; ?>/admin/comments/update" method="post">
  <input type="hidden" name="id" value="<?php echo $comment->id; ?>">
  <div>
    <label for="name">Nom:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($comment->getName()); ?>">
  </div>
  <div>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($comment->getEmail()); ?>">
  </div>
  <div>
    <label for="body">Contenu du commentaire:</label>
    <textarea name="body" id="body" cols="30" rows="10"><?php echo htmlspecialchars($comment->getBody()); ?></textarea>
  </div>
  <button type="submit">Mettre à jour le commentaire</button>

</form>
<?php require_once __DIR__ . '/../../partials/footer.php'; ?>