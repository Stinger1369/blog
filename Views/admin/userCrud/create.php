<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Create User</title>
</head>

<body>
  <h1>Create User</h1>

  <form method="POST" action="<?= BASE_URL ?>/admin/userCrud/create">

    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" required>

    <label for="role">Role</label>
    <select name="role" required>
      <option value="">-- Select role --</option>
      <option value="admin">Administrator</option>
      <option value="user">User</option>
    </select>

    <button type="submit">Create</button>
  </form>

</body>

</html>