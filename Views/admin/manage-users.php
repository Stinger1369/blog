<?php
require_once __DIR__ . '/../partials/header.php';



use Models\User;

$users = User::getAll();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Manage Users</title>
</head>

<body>
  <h1>Manage Users</h1>

  <a href="<?php echo BASE_URL; ?>/admin/userCrud/create">Create new user</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($users)) : ?>
        <?php foreach ($users as $user) : ?>
          <tr>
            <td><?php echo $user->getId(); ?></td>
            <td><?php echo $user->getName(); ?></td>
            <td><?php echo $user->getEmail(); ?></td>
            <td><?php echo $user->getRole(); ?></td>
            <td><?php echo $user->getCreated_At(); ?></td>
            <td><?php echo $user->getUpdated_At(); ?></td>
            <td>
              <a href="<?php echo BASE_URL; ?>/admin/userCrud/userUpdate/<?php echo $user->getId(); ?>">Edit</a>

              <form id="delete-user-form-<?php echo $user->getId(); ?>" method="POST" action="<?php echo BASE_URL; ?>/admin/userCrud/delete/<?php echo $user->getId(); ?>" onsubmit="return confirmDelete('<?php echo $user->getName(); ?>')">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="7">No users found.</td>
        </tr>
      <?php endif; ?>
      <script>
        function confirmDelete(username) {
          return confirm("Are you sure you want to delete user " + username + "?");
        }
      </script>
    </tbody>
  </table>
</body>

</html>