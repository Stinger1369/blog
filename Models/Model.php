<?php

namespace Models;

use PDO;
require_once __DIR__ . '/../config/database.php';


abstract class Model
{
  protected static $db;
  protected $id;

  public static function getDb()
  {
    if (!static::$db) {
      static::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
      static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return static::$db;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function save()
  {
    $db = static::getDb();

    $columns = array_filter(get_object_vars($this));
    $params = array_map(function ($column) {
      return ':' . $column;
    }, array_keys($columns));

    $query = 'INSERT INTO ' . static::getTableName() . ' (' . implode(', ', array_keys($columns)) . ') VALUES (' . implode(', ', $params) . ')';
    $stmt = $db->prepare($query);

    foreach ($columns as $column => $value) {
      $stmt->bindValue(':' . $column, $value);
    }

    $stmt->execute();

    if (method_exists($this, 'setId')) {
      $this->setId($db->lastInsertId());
    }
  }

  abstract protected static function getTableName();
}