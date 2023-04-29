<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <title>Add Post</title>
</head>

<body>
  <?php require_once __DIR__ . '/../../config/config.php';
  ?>
  <h1>Add Post</h1>
  <form action="<?php echo BASE_URL ?>/admin/save-post" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title">
    <br>
    <label for="body">Body:</label>
    <textarea name="body" id="body"></textarea>
    <br>
    <input type="submit" value="Save">
  </form>
</body>

</html>