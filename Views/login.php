<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="UTF-8">
  <title>Connexion - Mon blog</title>

</head>

<body>
  <?php include __DIR__ . '/partials/header.php'; ?>

  <main>
    <h1>Connexion</h1>
    <?php if (isset($_SESSION['error_message'])) : ?>
      <div class="error">
        <?php echo $_SESSION['error_message']; ?>
        <?php unset($_SESSION['error_message']); ?>
      </div>
    <?php endif; ?>
    <form action="<?php echo BASE_URL; ?>/login" method="post">
      <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div>
        <input type="submit" value="Se connecter">
      </div>
    </form>
  </main>

  <?php include __DIR__ . '/partials/footer.php'; ?>
</body>

</html>