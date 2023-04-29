<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Edit Comment</title>
</head>

<body>
  <h1>Edit Comment</h1>

  <form method="POST" action="/admin/update-comment.php">
    <input type="hidden" name="id" value="<?php echo $comment->getId(); ?>">

    <div>
      <label for="author">Author:</label>
      <input type="text" name="author" value="<?php echo $comment->getAuthor(); ?>">
    </div>

    <div>
      <label for="content">Content:</label>
      <textarea name="content"><?php echo $comment->getContent(); ?></textarea>
    </div>

    <div>
      <button type="submit">Save Changes</button>
    </div>
  </form>
</body>

</html>