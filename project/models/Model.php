<?php

namespace app\models;


use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
  protected $db;
  
  public function __construct() {
    $this->db = Db::getInstance();
  }
  
  public function getOne(int $id): Model {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
    return $this->db->queryOne($sql, [], get_class($this));
  }
  
  public function getAll(): array {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return $this->db->queryAll($sql, [], get_class($this));
  }
  
  public function insertDb($params) {
    if (true) {
      $namesColumn = implode(',', array_keys($params));
      $valuesArr = array_values($params);
      $tableName = $this->getTableName();
//      $sql = "INSERT INTO {$tableName} ($namesColumn) VALUES (?, ?, ?, ?)";
      $sql = "INSERT INTO {$tableName} ($namesColumn) VALUES (";
      $countVal = count($valuesArr);
      for ($i = 1; $i <= $countVal; $i++) {
        $sql .= '?';
        if ($i < $countVal) {
          $sql .= ',';
        }
      }
      $sql .= ')';
      $pdoStatement = $this->db->execute($sql, $valuesArr);
      if ((int)$pdoStatement->errorCode()) {
        echo 'Ошибка: ', $pdoStatement->errorInfo()[2];
      } else {
        if ($pdoStatement->rowCount()) {
          echo 'Успешно';
        } else {
          echo 'Ошибка';
        }
      }
    } else {
      echo 'Данные не переданы';
    }
  }
  
  public function updateDd($params) {
    $valuesArr = array_values($params);
    if (array_key_exists('id', $params)) {
      $whereColumn = 'id';
    } else {
      $whereColumn = $this->getWhereColumnName();
    }
    $tableName = $this->getTableName();
    
    $sql = "UPDATE {$tableName} SET ";
    foreach ($params as $col => $val) {
      $sql .= "{$col} = ?";
      if (next($params)) {
        $sql .= ',';
      }
    }
    $sql .= " WHERE {$whereColumn} = '{$params[$whereColumn]}'";
    $pdoStatement = $this->db->execute($sql, $valuesArr);
    if ((int)$pdoStatement->errorCode()) {
      echo 'Ошибка: ', $pdoStatement->errorInfo()[2];
    } else {
      if ($pdoStatement->rowCount()) {
        echo 'Успешно';
      } else {
        echo 'Ошибка';
      }
    }
  }
  
  public function deleteDb($param) {
    if (array_key_exists('id', $param)) {
      $whereColumn = 'id';
    } else {
      $whereColumn = $this->getWhereColumnName();
    }
    $tableName = $this->getTableName();
    
    $sql = "DELETE FROM {$tableName} WHERE {$whereColumn} = '{$param[$whereColumn]}'";
    $pdoStatement = $this->db->execute($sql);
    if ((int)$pdoStatement->errorCode()) {
      echo 'Ошибка: ', $pdoStatement->errorInfo()[2];
    } else {
      if ($pdoStatement->rowCount()) {
        echo 'Успешно';
      } else {
        echo 'Ошибка';
      }
    }
  }
  
}