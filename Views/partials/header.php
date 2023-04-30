<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - Accueil</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <!-- Ajout de Tailwind CSS -->
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <header class="bg-white shadow-md py-4">
    <nav class="container mx-auto px-4">
      <ul class="flex justify-between">
        <li><a href="/Blog" class="text-gray-800 font-bold">Blog</a></li>
        <?php if (isset($_SESSION['user_id'])) : ?>
          <li><a href="<?= BASE_URL ?>/admin" class="text-gray-800 hover:text-gray-600">Administration</a></li>
          <li><a href="/Blog/logout" class="text-gray-800 hover:text-gray-600">Logout</a></li>
          <li class="text-gray-800 font-bold">Bonjour <?php echo $_SESSION['user_name']; ?></li>
        <?php else : ?>
          <li><a href="/Blog/login" class="text-gray-800 hover:text-gray-600">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
</body>

</html>
