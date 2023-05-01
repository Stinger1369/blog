<?php require_once __DIR__ . '/../../partials/header.php'; ?>





<form method="POST" action="/admin/userCrud/register">
  <div>
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required>
  </div>
  <div>
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
  </div>
  <div>
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required>
  </div>
  <div>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
  </div>
  <div>
    <button type="submit">S'inscrire</button>
  </div>
</form>