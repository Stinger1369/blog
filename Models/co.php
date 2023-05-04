<?php

namespace Models;

use PDO;
use Exception;
use Config\Database;



require_once __DIR__ . '/Model.php';

class Comment extends Model
{
  protected $id;
  protected $postId;
  protected $userId;
  protected $user;

  protected $body;
  protected $name;
  protected $email;
  protected $created_at;
  protected $updated_at;



  public function __construct($postId = null, $name = null, $email = null, $body = null)
  {
    $this->postId = $postId;
    $this->name = $name;
    $this->email = $email;
    $this->body = $body;
    $this->created_at = date('Y-m-d H:i:s');
    $this->updated_at = date('Y-m-d H:i:s');
  }
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }

  public function getEmail()
  {
    return $this->email;
  }
  public function getPostId()
  {
    return $this->postId;
  }

  public function setPostId($postId)
  {
    $this->postId = $postId;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  public function getBody()
  {
    return $this->body;
  }

  public function setBody($body)
  {
    $this->body = $body;
  }

  public function getcreatedAt()
  {
    return $this->created_at;
  }

  public function setcreated_at($created_at)
  {
    $this->created_at = $created_at;
  }

  public function getupdated_at()
  {
    return $this->updated_at;
  }

  public function setupdated_at($updated_at)
  {
    $this->updated_at = $updated_at;
  }

  public static function getAllByPostId($postId)
  {
    $db = static::getDb();

    $query = 'SELECT * FROM comments WHERE postId = :postId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
  }


  protected static function getTableName()
  {
    return 'comments';
  }
  public function delete()
  {
    $db = static::getDb();

    $query = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    $stmt->execute();
  }
  public static function findById($id)
  {
    $db = static::getDb();

    $query = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchObject(static::class);
    if (!$result) {
      throw new Exception('Comment not found');
    }

    return $result;
  }

  public function save()
  {
    $db = static::getDb();

    if ($this->id) {
      // Update the existing comment
      $query = 'UPDATE comments SET post_id = :postId, user_id = :userId, name = :name, email = :email, body = :body, created_at = :created_at, updated_at = :updated_at WHERE id = :id';
      $stmt = $db->prepare($query);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    } else {
      // Insert a new comment
      $query = 'INSERT INTO comments (post_id, user_id, name, email, body, created_at, updated_at) VALUES (:postId, :userId, :name, :email, :body, :created_at, :updated_at)';
      $stmt = $db->prepare($query);
      $stmt->bindParam(':created_at', $this->created_at, PDO::PARAM_STR);
    }

    $stmt->bindParam(':postId', $this->postId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
    $stmt->bindParam(':body', $this->body, PDO::PARAM_STR);
    $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);
    $stmt->execute();

    if (!$this->id) {
      $this->id = $db->lastInsertId();
    }
  }



  public static function getAll()
  {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare('SELECT * FROM comments ORDER BY created_At DESC');
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $comments = [];

    foreach ($results as $result) {
      $comment = new static();
      $comment->setId($result['id']);
      $comment->setPostId($result['postId']);
      $comment->setUserId(isset($result['userId']) ? $result['userId'] : null); // Change this line
      $comment->setBody($result['body']);
      $comment->setName($result['name']);
      $comment->setEmail($result['email']);
      $comment->setcreated_at(isset($result['created_At']) ? $result['created_At'] : null); // Change this line
      $comment->setupdated_at(isset($result['updated_at']) ? $result['updated_at'] : null); // Change this line

      $comments[] = $comment;
    }

    return $comments; // Retourne les résultats
  }
  public function createComment()
  {
    $sql = "INSERT INTO comments (postId, name, email, body, created_At) VALUES (:postId, :name, :email, :body, :created_At)";
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':postId', $this->postId, PDO::PARAM_INT);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':body', $this->body);
    $stmt->bindParam(':created_At', $this->created_at);

    $stmt->execute();
  }
  public static function getByPostId($postId)
  {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE postId = ?');
    $stmt->execute([$postId]);

    $comments = [];
    while ($row = $stmt->fetch()) {
      $comment = new Comment(
        $row['postId'],
        $row['name'],
        $row['email'],
        $row['body'],
        $row['id'],
        $row['created_At'],
        NULL // There is no updated_at column in your comments table
      );
      $comments[] = $comment;
    }

    return $comments;
  }
  public static function getCommentsForPost($postId)
  {
    $comments = Comment::getByPostId($postId);
    return $comments;
  }
  public static function getById($id)
  {
    $db = static::getDb();
    $req = $db->prepare('SELECT * FROM comments WHERE id = :id');
    $req->execute(array('id' => $id));
    $comment = $req->fetchObject(static::class);

    if ($comment) {
      return $comment;
    } else {
      return false;
    }
  }
}
