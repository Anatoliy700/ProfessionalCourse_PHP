<?php

namespace app\models;


use app\interfaces\IDbModel;
use app\services\Db;

abstract class DbModel implements IDbModel
{
  protected $db;
  protected $updateProp = [];
  
  
  public function __construct() {
    $this->db = Db::getInstance();
  }

//  public function __get($name) {
//    return $this->$name;
//  }

//  public function __set($name, $value) {
//    if ($name == 'id') {
//      throw new \Error('Cannot access protected property');
//    } else {
//      $this->$name = $value;
//      $this->updateProp[] = $name;
//    }
//  }
  
  
  /**
   * @param $name
   * @return mixed
   */
  public function getProp($name) {
    return $this->$name;
  }
  
  
  /**
   * @param int $id
   * @return static
   */
  public static function getOne(int $id): DbModel {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";
    return Db::getInstance()->queryOne($sql, [':id' => $id], get_called_class());
  }
  
  /**
   * @return static[]
   */
  public static function getAll(): array {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return Db::getInstance()->queryAll($sql, [], get_called_class());
  }
  
  /**
   * @param array $arrId
   * @return static[]
   */
  public static function getSelect($arrId): array {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id IN (";
    foreach ($arrId as $id) {
      $sql .= '?';
      if (next($arrId)) {
        $sql .= ',';
      }
    }
    $sql .= ')';
    return Db::getInstance()->queryAll($sql, $arrId, get_called_class());
  }
  
  private function insert() {
    $params = [];
    $columns = [];
    
    $reflect = new \ReflectionClass($this);
    $props = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
    
    var_dump($props);
    
    foreach ($props as $key => $value) {
      /**TODO решшить проблемы со служебнными полями */
      $value->setAccessible(true);
      $params[":{$value->getName()}"] = $value->getValue($this);
      $columns[] = "`{$value->getName()}`";
    }
    var_dump($params, $columns);
    $columns = implode(", ", $columns);
    $placeholders = implode(", ", array_keys($params));
    $tableName = static::getTableName();
    $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
    $pdoStatement = $this->db->execute($sql, $params);
    
    if ((int)$pdoStatement->errorCode()) {
      echo 'Ошибка: ', $pdoStatement->errorInfo()[2];
    } else {
      if ($pdoStatement->rowCount()) {
        $this->id = $this->db->lastInsertId();
//        echo 'Успешно';
      } else {
        echo 'Ошибка';
      }
    }
  }
  
  private function update() {
    $params = [];
    $columns = [];
    
    if (count($this->updateProp) > 0) {
      foreach ($this->updateProp as $propName) {
        /**TODO решшить проблемы со служебнными полями */
        /*      if ($key == 'db') {
                continue;
              }*/
        
        $params[":{$propName}"] = $this->$propName;
        $columns[] = "`{$propName}` = :{$propName}";
        /*        if ($key != 'id') {
                  $columns[] = "`{$key}` = :{$key}";
                }*/

      }
      $params[":id"] = $this->id;
      var_dump($params, $columns);
      $placeholders = implode(", ", $columns);
      $tableName = static::getTableName();
      
      $sql = "UPDATE {$tableName} SET {$placeholders} WHERE `id` = :id";
      $pdoStatement = $this->db->execute($sql, $params);
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
  
  public function delete() {
    $tableName = static::getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";
    $pdoStatement = $this->db->execute($sql, [":id" => $this->id]);
    
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
  
  public function save() {
    if (is_null($this->id)) {
      $this->insert();
    } else {
      $this->update();
    }
  }
}