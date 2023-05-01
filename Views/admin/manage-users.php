<?php require_once __DIR__ . '/../partials/header.php';
use Models\User; ?>
<?php $users = User::getAll(); ?>

<body class="bg-gray-100 font-sans">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Manage Users</h1>

    <a href="<?php echo BASE_URL; ?>/admin/userCrud/create" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Create new user</a>

    <table class="table-auto w-full">
      <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
          <th class="py-3 px-6 text-left">ID</th>
          <th class="py-3 px-6 text-left">Name</th>
          <th class="py-3 px-6 text-left">Email</th>
          <th class="py-3 px-6 text-left">Role</th>
          <th class="py-3 px-6 text-left">Created At</th>
          <th class="py-3 px-6 text-left">Updated At</th>
          <th class="py-3 px-6 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($users)) : ?>
          <?php foreach ($users as $user) : ?>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="py-4 px-6"><?php echo $user->getId(); ?></td>
              <td class="py-4 px-6"><?php echo $user->getName(); ?></td>
              <td class="py-4 px-6"><?php echo $user->getEmail(); ?></td>
              <td class="py-4 px-6"><?php echo $user->getRole(); ?></td>
              <td class="py-4 px-6"><?php echo $user->getCreated_At(); ?></td>
              <td class="py-4 px-6"><?php echo $user->getUpdated_At(); ?></td>
              <td class="py-4 px-6 text-center">
                <div class="flex justify-center">
                  <a href="<?php echo BASE_URL; ?>/admin/userCrud/userUpdate/<?php echo $user->getId(); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>

                  <form id="delete-user-form-<?php echo $user->getId(); ?>" method="POST" action="<?php echo BASE_URL; ?>/admin/userCrud/delete/<?php echo $user->getId(); ?>" onsubmit="return confirmDelete('<?php echo $user->getName(); ?>')">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="7" class="text-center py-4">No users found.</td>
          </tr>
        <?php endif; ?>
      </tbody>








    </table>
  </div>
  <script>
    function confirmDelete(username) {
      return confirm("Are you sure you want to delete user " + username + "?");
    }
  </script>
  </tbody>
  </table>
</body>

</html>