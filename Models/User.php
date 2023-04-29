<?php

namespace Models;

require_once __DIR__ . '/../Config/Database.php';

use Config\Database;

class User
{
  protected $id;
  protected $name;
  protected $email;
  protected $password;
  protected $passwordHash;
  protected $createdAt;
  protected $updatedAt;
  protected $role;
  protected $db;

  public function __construct($email = null, $passwordHash = null, $id = null, $name = null, $createdAt = null, $updatedAt = null, $role = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->passwordHash = $passwordHash;
    $this->createdAt = $createdAt;
    $this->updatedAt = $updatedAt;
    $this->role = $role;
    $this->db = Database::getInstance()->getConnection();
  }

  public static function getById($id)
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$id]);

    if ($row = $stmt->fetch()) {
      $user = new User($row['email'], $row['password_hash'], $row['id'], $row['name'], $row['created_at'], $row['updated_at'], $row['role']);
      return $user;
    }

    return null;
  }

  public function save()
  {
    $pdo = Database::getInstance()->getConnection();

    if ($this->id === null) {
      $stmt = $pdo->prepare('INSERT INTO user (email, password_hash, created_at, updated_at) VALUES (?, ?, ?, ?)');
      $stmt->execute([$this->email, $this->passwordHash, $this->createdAt, $this->updatedAt]);

      $this->id = $pdo->lastInsertId();
    } else {
      $stmt = $pdo->prepare('UPDATE user SET email = ?, password_hash = ?, updated_at = ? WHERE id = ?');
      $stmt->execute([$this->email, $this->passwordHash, $this->updatedAt, $this->id]);
    }
  }

  public static function getAll()
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->query('SELECT * FROM user');

    $users = [];
    while ($row = $stmt->fetch()) {
      $user = new User($row['email'], $row['password_hash'], $row['id'], $row['name'], $row['created_at'], $row['updated_at'], $row['role']);
      $users[] = $user;
    }

    return $users;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getRole()
  {
    return $this->role;
  }
  public function setRole($role)
  {
    $this->role = $role;
  }

  public function delete()
  {
    // Prepare the delete query
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $GLOBALS['pdo']->prepare($sql);

    // Bind the user ID to the query
    $stmt->bindValue(':id', $this->id);

    // Execute the query
    return $stmt->execute();
  }

// Getters and setters
public function getId()
{
return $this->id;
}

public function getEmail()
{
return $this->email;
}

public function setEmail($email)
{
$this->email = $email;
}

public function getPasswordHash()
{
return $this->passwordHash;
}

public function setPasswordHash($passwordHash)
{
$this->passwordHash = $passwordHash;
}

public function getCreatedAt()
{
return $this->createdAt;
}

public function setCreatedAt($createdAt)
{
$this->createdAt = $createdAt;
}

public function getUpdatedAt()
{
return $this->updatedAt;
}

public function setUpdatedAt($updatedAt)
{
$this->updatedAt = $updatedAt;
}

public function authenticate($email, $password)
{
$db = Database::getInstance()->getConnection();$stmt = $db->prepare('SELECT * FROM user WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
  return new User($user['email'], $user['password_hash'], $user['id'], $user['name'], $user['created_at'], $user['updated_at'], $user['role']);

} else {
  return null;
    }
  }
}