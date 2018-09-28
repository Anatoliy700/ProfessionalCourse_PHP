<?php

namespace app\models\repositories;


use app\models\entities\Cart;
use app\models\entities\DataEntity;
use app\services\Session;

abstract class SessionRepository extends Repository
{
  
  protected $ss;
  
  /**
   * CartRepository constructor.
   */
  public function __construct() {
    $this->ss = new Session($this->getTableName());
  }
  
  public function get() {
    if ($this->ss->getData()) {
      return $this->getOne();
    }
    return null;
  }
  
  /**
   * @param int|null $id
   * @return DataEntity
   */
  public function getOne(int $id = null): DataEntity {
    $className = $this->getEntityClass();
    $reflectionClass = new \ReflectionClass($className);
    return $reflectionClass->newInstanceArgs($this->ss->getData());

//    return new $className($this->ss->getData());
  }
  
  public function getAll(): array {
  }
  
  public function getSelect($arrId): array {
  }
  
  public function delete(DataEntity $entity) {
    $this->ss->save(null);
  }
  
  //TODO: сохранять в сессию тока id товара и количество
  public function save(DataEntity $entity) {
    $this->ss->save($entity->toArray());
  }
}