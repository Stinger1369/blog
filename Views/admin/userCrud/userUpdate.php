<?php
require_once __DIR__ . '/../../partials/header.php';
?>



<body class="bg-gray-100 font-sans">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit User</h1>

    <form method="POST" action="<?php echo BASE_URL; ?>/admin/userCrud/userUpdate/<?php echo $user->getId(); ?>" class="w-full max-w-md">
      <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">

      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $user->getName(); ?>" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>

      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $user->getEmail(); ?>" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>

      <div class="mb-4">
        <label for="role" class="block text-gray-700 font-bold mb-2">Role</label>
        <div class="relative">
          <select name="role" id="role" class="block appearance-none w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="user" <?php echo $user->getRole() === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo $user->getRole() === 'admin' ? 'selected' : ''; ?>>Admin</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M10 12l-6-6h12z" />
            </svg>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save</button>
      </div>
    </form>
  </div>
</body>


</html>