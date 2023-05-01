<?php
require_once __DIR__ . '/../../partials/header.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Edit User</title>
</head>

<body>
  <h1>Edit User</h1>
  <form method="POST" action="<?php echo BASE_URL; ?>/admin/userCrud/userUpdate/<?php echo $user->getId(); ?>">
    <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $user->getName(); ?>"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $user->getEmail(); ?>"><br>
    <label for="role">Role:</label>
    <select name="role">
      <option value="user" <?php echo $user->getRole() === 'user' ? 'selected' : ''; ?>>User</option>
      <option value="admin" <?php echo $user->getRole() === 'admin' ? 'selected' : ''; ?>>Admin</option>
    </select><br>
    <button type="submit">Save</button>
  </form>
</body>

</html>