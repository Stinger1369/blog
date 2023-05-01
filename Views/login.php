<?php include __DIR__ . '/partials/header.php'; ?>

<body class="flex flex-col min-h-screen">
  <main class="container mx-auto px-4 flex-grow flex flex-col items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md max-w-sm w-full">
      <h1 class="text-2xl font-bold mb-4">Connexion</h1>
      <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
          <?php echo $_SESSION['error_message']; ?>
          <?php unset($_SESSION['error_message']); ?>
        </div>
      <?php endif; ?>
      <form action="<?php echo BASE_URL; ?>/login" method="post">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="email">
            Email :
          </label>
          <input class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" id="email" name="email" required>
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 font-bold mb-2" for="password">
            Mot de passe :
          </label>
          <input class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="password" name="password" required>
        </div>
        <div>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Se connecter
          </button>
        </div>
      </form>
    </div>
  </main>


  <?php include __DIR__ . '/partials/footer.php'; ?>