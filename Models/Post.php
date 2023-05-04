<?php

namespace Models;

require_once __DIR__ . '/../Config/Database.php';

use Config\Database;
use Models\Comment;
class Post
{
  protected $id;
  protected $title;
  protected $body;
  protected $userId;
  protected $created_at;
  protected $updated_At;
  protected $comments;


  public function __construct($title, $body, $userId, $id = null, $created_at = null, $updated_At = null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->body = $body;
    $this->userId = $userId;
    $this->created_at = $created_at;
    $this->updated_At = $updated_At;
  }
  public static function getAll()
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC, id DESC');
        $posts = [];

    while ($row = $stmt->fetch()) {
      $post = new Post($row['title'], $row['body'], $row['userId'] ?? null, $row['id'], $row['created_at'], $row['updated_at'] ?? null);
      $posts[] = $post;
    }

    return $posts;
  }

  public static function getLatestPosts($limit, $offset)
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare('SELECT * FROM posts ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
    $stmt->execute();

    $posts = [];

    while ($row = $stmt->fetch()) {
      $post = new Post($row['title'], $row['body'], $row['userId'] ?? null, $row['id'], $row['created_at'], $row['updated_at'] ?? null);
      $posts[] = $post;
    }

    return $posts;
  }

  public static function getTotalPosts()
  {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM posts');
    $stmt->execute();

    return $stmt->fetchColumn();
  }

  public static function getById($id)
  {
    $pdo = Database::getInstance()->getConnection();


    $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
    $stmt->execute([$id]);

    if ($row = $stmt->fetch()) {
      $post = new Post($row['title'], $row['body'], $row['userId'], $row['id'], $row['created_at'], $row['updated_at']);
      return $post;
    }

    return null;
  }

  public function save()
  {
    $pdo = Database::getInstance()->getConnection();
    $currentDateTime = date('Y-m-d H:i:s');

    if ($this->id === null) {
      $this->created_at = $currentDateTime;
      $stmt = $pdo->prepare('INSERT INTO posts (title, body, userId, created_at, updated_at) VALUES (?, ?, ?, ?, ?)');
      $stmt->execute([$this->title, $this->body, $this->userId, $this->created_at, $this->updated_At ?? $currentDateTime]);



      $this->id = $pdo->lastInsertId();
    } else {
      $this->updated_At = $currentDateTime;
      $stmt = $pdo->prepare('UPDATE posts SET title = ?, body = ?, userId = ?, updated_at = ? WHERE id = ?');
      $stmt->execute([$this->title, $this->body, $this->userId, $this->updated_At ?? $currentDateTime, $this->id]);
    }
  }




  public function delete()
  {
    $pdo = Database::getInstance()->getConnection();

    // Delete comments associated with the post
    $stmt = $pdo->prepare('DELETE FROM comments WHERE postId = ?');
    $stmt->execute([$this->id]);

    // Delete the post
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    $stmt->execute([$this->id]);
  }


  public function setId($id)
  {
    $this->id = $id;
  }
  // Getters and setters
  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getBody()
  {
    return $this->body;
  }

  public function setBody($body)
  {
    $this->body = $body;
  }

  public function getcreated_at()
  {
    return $this->created_at;
  }

  public function setcreated_at($created_at)
  {
    $this->created_at = $created_at;
  }

  public function getupdated_At()
  {
    return $this->updated_At;
  }

  public function setUpdatedAt($updated_At)
  {
    $this->updated_At = $updated_At;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  public function getUser()
  {
    // Récupération de l'utilisateur associé à ce post
    return User::getById($this->userId);
  }


  public function getComments()
  {
    // Récupération des commentaires associés à ce post
    return Comment::getByPostId($this->id);
  }

  public function setComments($comments)
  {
    $this->comments = $comments;
  }

  public function getCommentsForPost($postId)
  {
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare('SELECT * FROM comments WHERE post_id = :postId');
    $stmt->bindValue(':postId', (int) $postId, \PDO::PARAM_INT);
    $stmt->execute();

    $comments = [];

    while ($row = $stmt->fetch()) {
      $comment = new Comment($row['email'], $row['body'], $row['post_id'], $row['id'], $row['created_at'], $row['updated_at'] ?? null);
      $comments[] = $comment;
    }

    return $comments;
  }


}
