<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . '/../../controllers/AdminController.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Édition de post</title>
</head>

<body>
  <h1>Édition de post</h1>
  <form method="POST" action="<?php echo BASE_URL; ?>/admin/edit-post?id=<?php echo $post->getId(); ?>">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="body" name="body" rows="5"><?php echo htmlspecialchars($body); ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>

</html>