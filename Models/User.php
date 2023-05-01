<?php

namespace Models;

require_once __DIR__ . '/../Config/Database.php';

use Config\Database;

class User
{
  protected $id;
  protected $name;
  protected $username;
  protected $password;
  protected $email;
  protected $passwordHash;
  protected $created_At;
  protected $updated_At;
  protected $role;
  protected $db;

  public function __construct($email = null, $passwordHash = null, $id = null, $name = null, $username = null, $created_At = null, $updated_At = null, $role = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
    $this->email = $email;
    $this->passwordHash = $passwordHash;
    $this->created_At = $created_At;
    $this->updated_At = $updated_At;
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
    if (!$this->db) {
      $this->db = Database::getInstance()->getConnection();
    }
    $pdo = Database::getInstance()->getConnection();

    // Mettre à jour le champ updated_at
    $this->updated_At = date("Y-m-d H:i:s");

    if ($this->id === null) {
      $stmt = $pdo->prepare('INSERT INTO user (name, email, password_hash, role, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)');
      $stmt->execute([$this->name, $this->email, $this->passwordHash, $this->role, $this->created_At, $this->updated_At]);
      $this->id = $pdo->lastInsertId();
    } else {
      $stmt = $pdo->prepare('UPDATE user SET name = ?, email = ?, password_hash = ?, role = ?, updated_at = ? WHERE id = ?');
      $stmt->execute([$this->name, $this->email, $this->passwordHash, $this->role, $this->updated_At, $this->id]);
    }
  }


  public static function getAll()
  {
    $db = Database::getInstance();
    if (!$db->getConnection()) {
      return null;
    }

    $pdo = $db->getConnection();

    $stmt = $pdo->query('SELECT * FROM user');

    $users = [];
    while ($row = $stmt->fetch()) {
      $user = new User($row['email'], $row['password_hash'], $row['id'], $row['name'], $row['username'], $row['created_at'], $row['updated_at'], $row['role']);
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
  public function deleteAssociatedPosts()
  {
    // Supprimer d'abord les commentaires associés aux articles de l'utilisateur
    $sql = "DELETE comments FROM comments INNER JOIN posts ON comments.postId = posts.id WHERE posts.userId = :id";

    if (!$this->db) {
      $this->db = Database::getInstance()->getConnection();
    }
    $stmt = $this->db->prepare($sql);

    // Associer l'ID utilisateur à la requête
    $stmt->bindValue(':id', $this->id);

    // Exécuter la requête
    $stmt->execute();

    // Supprimer les articles de l'utilisateur
    $sql = "DELETE FROM posts WHERE userId = :id";

    $stmt = $this->db->prepare($sql);

    // Associer l'ID utilisateur à la requête
    $stmt->bindValue(':id', $this->id);

    // Exécuter la requête
    return $stmt->execute();
  }

  public function delete()
  {
    // Supprimer tous les articles associés à l'utilisateur
    $this->deleteAssociatedPosts();

    // Préparer la requête de suppression
    $sql = "DELETE FROM user WHERE id = :id";

    if (!$this->db) {
      $this->db = Database::getInstance()->getConnection();
    }
    $stmt = $this->db->prepare($sql);

    // Associer l'ID utilisateur à la requête
    $stmt->bindValue(':id', $this->id);

    // Exécuter la requête
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

public function getCreated_At()
{
return $this->created_At;
}

public function setCreated_At($created_At)
{
$this->created_At = $created_At;
}

public function getUpdated_At()
{
return $this->updated_At;
}

public function setUpdated_At($updated_At)
{
$this->updated_At = $updated_At;
}

  public function authenticate($email, $password)
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
    $stmt->execute([$email]);
    $result = $stmt->fetch();

    if ($result && password_verify($password, $result['password_hash'])) {
      $user = new User();
      $user->setId($result['id']);
      $user->setName($result['name']);
      $user->setEmail($result['email']);
      $user->setRole($result['role']);
      return $user;
    }

    return false;
  }
}