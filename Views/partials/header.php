<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - Accueil</title>
  <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="/Blog">Blog</a></li>
        <?php if (isset($_SESSION['user_id'])) : ?>
          <li><a href="<?= BASE_URL ?>/admin">Administration</a></li>
          <li><a href="/Blog/logout">Logout</a></li>
          <li>Bonjour <?php echo $_SESSION['user_name']; ?></li>
        <?php else : ?>
          <li><a href="/Blog/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>