<body>
  <?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>
  <div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Inscription</h1>
    <form action="/register" method="post">
      <?php if (isset($error)) : ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?= $error ?></div>
      <?php endif ?>
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Nom d'utilisateur:</label>
        <input type="text" name="name" id="name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold mb-2">Adresse email:</label>
        <input type="email" name="email" id="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe:</label>
        <input type="password" name="password" id="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      </div>
      <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">S'inscrire</button>
      </div>
    </form>
  </div>
</body>

</html>