<?php

namespace app\models\repositories;


use app\models\entities\Cart;
use app\models\entities\DataEntity;

class CartRepository extends SessionRepository
{
  
  protected function getTableName(): string {
    return 'carts';
  }
  
  protected function getEntityClass() {
    return Cart::class;
  }
  
  
  /**
   * @param int|null $id
   * @return DataEntity
   */
  public function getOne(int $id = null): DataEntity {
    $className = $this->getEntityClass();
    $reflectionClass = new \ReflectionClass($className);
    return $reflectionClass->newInstanceArgs($this->get());

//    return new $className($this->ss->getData());
  }
  
  
  public function delete(DataEntity $entity) {
    $this->set();
  }
  
  //TODO: сохранять в сессию тока id товара и количество
  public function save(DataEntity $entity) {
    $this->set($entity);
  }
}