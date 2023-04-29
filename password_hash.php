<?php

require_once 'Config/Database.php';

use Config\Database;

$db = Database::getInstance()->getConnection();

$stmt = $db->prepare('SELECT id, password_hash FROM user');
$stmt->execute();

while ($row = $stmt->fetch()) {
    $id = $row['id'];
    $password_hash = $row['password_hash'];
    $new_password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
    $stmt2 = $db->prepare('UPDATE user SET password_hash = ? WHERE id = ?');
    $stmt2->execute([$new_password_hash, $id]);
}

echo "Les mots de passe ont été mis à jour.";
