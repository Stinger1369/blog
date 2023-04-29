<?php

namespace Models;

use PDO;
use Exception;

require_once __DIR__ . '/Model.php';

class Comment extends Model
{
  protected $id;
  protected $postId;
  protected $userId;
  protected $body;
  protected $createdAt;
  protected $updatedAt;

  public function __construct($postId, $userId, $body)
  {
    $this->postId = $postId;
    $this->userId = $userId;
    $this->body = $body;
    $this->createdAt = date('Y-m-d H:i:s');
    $this->updatedAt = date('Y-m-d H:i:s');
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

  public static function getAllByPostId($postId)
  {
    $db = static::getDb();

    $query = 'SELECT * FROM comments WHERE post_id = :postId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS, 'Comment');
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
      $query = 'UPDATE ' . static::getTableName() . ' SET post_id = :postId, user_id = :userId, body = :body, updated_at = :updatedAt WHERE id = :id';
      $stmt = $db->prepare($query);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    } else {
      // Insert a new comment
      $query = 'INSERT INTO ' . static::getTableName() . ' (post_id, user_id, body, created_at, updated_at) VALUES (:postId, :userId, :body, :createdAt, :updatedAt)';
      $stmt = $db->prepare($query);
      $stmt->bindParam(':createdAt', $this->createdAt, PDO::PARAM_STR);
    }

    $stmt->bindParam(':postId', $this->postId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
    $stmt->bindParam(':body', $this->body, PDO::PARAM_STR);
    $stmt->bindParam(':updatedAt', $this->updatedAt, PDO::PARAM_STR);
    $stmt->execute();

    if (!$this->id) {
      $this->id = $db->lastInsertId();
    }
  }
}
