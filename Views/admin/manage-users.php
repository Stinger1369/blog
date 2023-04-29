<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Manage Users</title>
</head>

<body>
  <h1>Manage Users</h1>

  <a href="/admin/users/create">Create new user</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?php echo $user->getId(); ?></td>
          <td><?php echo $user->getName(); ?></td>
          <td><?php echo $user->getEmail(); ?></td>
          <td><?php echo $user->getCreatedAt(); ?></td>
          <td><?php echo $user->getUpdatedAt(); ?></td>
          <td>
            <a href="/admin/users/<?php echo $user->getId(); ?>/edit">Edit</a>
            <form method="POST" action="/admin/users/<?php echo $user->getId(); ?>/delete" onsubmit="return confirm('Are you sure you want to delete this user?')">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>