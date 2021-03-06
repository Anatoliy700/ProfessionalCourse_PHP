<?php


namespace app\models\repositories;


use app\base\App;
use app\interfaces\IRepository;
use app\models\entities\DataEntity;
use app\models\entities\Product;
use app\services\exception\RepositoryException;


abstract class Repository implements IRepository
{
  protected $db;
  
  public function __construct() {
    $this->db = App::call()->db;
  }
  
  abstract protected function getTableName(): string;
  
  abstract protected function getEntityClass();
  
  
  /**
   * @param int $id
   * @return DataEntity
   * @throws RepositoryException
   * @throws \Exception
   */
  public function getOne(int $id): DataEntity {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";
    $response = $this->db->queryOne($sql, [':id' => $id], $this->getEntityClass());
    if ($response instanceof DataEntity) {
      return $response;
    } elseif ($this->getEntityClass() == Product::class) {
      throw new RepositoryException('Продукт не найден');
    } else {
      throw new \Exception();
    }
  }
  
  /**
   * @return array
   */
  public function getAll($param = null): array {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return $this->db->queryAll($sql, [], $this->getEntityClass());
  }
  
  /**
   * @param $arrId
   * @return array
   */
  public function getSelect($arrId): array {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id IN (";
    foreach ($arrId as $id) {
      $sql .= '?';
      if (next($arrId)) {
        $sql .= ',';
      }
    }
    $sql .= ')';
    return $this->db->queryAll($sql, $arrId, $this->getEntityClass());
  }
  
  protected function insert(DataEntity $entity) {
    $params = [];
    $columns = [];
    
    $reflect = new \ReflectionClass($entity);
    $props = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
    
    foreach ($props as $key => $value) {
      /**TODO решшить проблемы со служебнными полями */
      $value->setAccessible(true);
      $params[":{$value->getName()}"] = $value->getValue($entity);
      $columns[] = "`{$value->getName()}`";
    }
    $columns = implode(", ", $columns);
    $placeholders = implode(", ", array_keys($params));
    $tableName = $this->getTableName();
    $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
    $pdoStatement = $this->db->execute($sql, $params);
    
    if ((int)$pdoStatement->errorCode()) {
      throw new RepositoryException('Ошибка: ' . $pdoStatement->errorInfo()[2],
        $pdoStatement->errorCode(),
        $entity->getProp('login'));
    } else {
      if ($pdoStatement->rowCount()) {
        //TODO доработать добавление id
        $entity->setId($this->db->lastInsertId());
      } else {
        throw new RepositoryException('Ошибка: не добавлено');
      }
    }
  }
  
  protected function update(DataEntity $entity) {
    $params = [];
    $columns = [];
    
    if (count($entity->getUpdateProp()) > 0) {
      foreach ($entity->getUpdateProp() as $propName) {
        /**TODO решшить проблемы со служебнными полями */
        $params[":{$propName}"] = $entity->$propName;
        $columns[] = "`{$propName}` = :{$propName}";
      }
      $params[":id"] = $entity->id;
      $placeholders = implode(", ", $columns);
      $tableName = $this->getTableName();
      
      $sql = "UPDATE {$tableName} SET {$placeholders} WHERE `id` = :id";
      $pdoStatement = $this->db->execute($sql, $params);
      if ((int)$pdoStatement->errorCode()) {
        throw new RepositoryException('Ошибка: ' . $pdoStatement->errorInfo()[2]);
      } else {
        if (!$pdoStatement->rowCount()) {
          throw new RepositoryException('Ошибка: не обновлено');
        }
      }
    }
  }
  
  public function delete(DataEntity $entity) {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";
    $pdoStatement = $this->db->execute($sql, [":id" => $entity->id]);
    
    if ((int)$pdoStatement->errorCode()) {
      throw new RepositoryException('Ошибка: ' . $pdoStatement->errorInfo()[2]);
    } else {
      if ($pdoStatement->rowCount()) {
      } else {
        throw new RepositoryException('Ошибка: не удалено');
      }
    }
  }
  
  public function save(DataEntity $entity) {
    if (is_null($entity->id)) {
      $this->insert($entity);
    } else {
      $this->update($entity);
    }
  }
}