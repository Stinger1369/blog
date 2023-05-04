<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Mon blog</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
  <!--<link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
  <header class="bg-gray-800 text-white py-2 px-4 md:px-8">
    <nav class="flex justify-between">
      <div class="flex items-center">
        <a href="/Blog" class="text-2xl font-bold">Blog</a>
      </div>

      <ul class="flex items-center space-x-4">
        <?php if (isset($_SESSION['user_id'])) : ?>
          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
            <li><a href="<?= BASE_URL ?>/admin" class="hover:text-gray-300">Administration</a></li>
          <?php endif; ?>

          <li><a href="<?= BASE_URL ?>/logout" class="hover:text-gray-300">Logout</a></li>
          <li class="text-gray-300">Bonjour <?php echo $_SESSION['user_name']; ?></li>
        <?php else : ?>
          <li><a href="<?= BASE_URL ?>/login" class="hover:text-gray-300">Login</a></li>
          <!--<li><a href="<?= BASE_URL ?>/register" class="hover:text-gray-300">Inscription</a></li>-->
        <?php endif; ?>
      </ul>
    </nav>
  </header>
</body>

</html>