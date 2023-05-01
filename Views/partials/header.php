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
   <!-- <pre>
//<?php print_r($_SESSION);?> </pre>-->
    <nav>
      <ul>
        <li><a href="/Blog">Blog</a></li>

        <?php if (isset($_SESSION['user_id'])) : ?>
          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
            <li><a href="<?= BASE_URL ?>/admin">Administration</a></li>
          <?php endif; ?>

          <li><a href="<?= BASE_URL ?>/logout">Logout</a></li>
          <li>Bonjour <?php echo $_SESSION['user_name']; ?></li>
        <?php else : ?>
          <li><a href="<?= BASE_URL ?>/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>