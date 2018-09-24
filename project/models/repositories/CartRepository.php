<?php

namespace app\models\repositories;


use app\models\entities\Cart;
use app\models\entities\DataEntity;
use app\services\Session;

class CartRepository extends Repository
{
  
  protected $ss;
  
  /**
   * CartRepository constructor.
   */
  public function __construct() {
    $this->ss = new Session($this->getTableName());
  }
  
  
  protected function getTableName(): string {
    return 'carts';
  }
  
  protected function getEntityClass() {
    return Cart::class;
  }
  
  public function getOne(int $id): DataEntity {
    return $this->getCartFromSession();
  }
  
  public function getAll(): array {
  }
  
  public function getSelect($arrId): array {
  }
  
  public function delete(DataEntity $entity) {
    $this->ss->save(null);
  }
  
  public function save(DataEntity $entity) {
    $this->saveToSession($entity);
  }
  
  /**
   * @return DataEntity
   */
  private function getCartFromSession(): DataEntity {
    $className = $this->getEntityClass();
    return new $className($this->ss->getData());
  }
  
  //TODO: сохранять в сессию тока id товара и количество
  private function saveToSession($entity) {
    $this->ss->save($entity->toArray());
  }
  
  
}