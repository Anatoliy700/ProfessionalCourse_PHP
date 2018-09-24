<?php


namespace app\models\repositories;


use app\models\entities\Product;

class ProductRepository extends Repository
{
  protected function getTableName(): string {
    return 'products';
  }
  
  protected function getEntityClass() {
    return Product::class;
  }
  
  public function getProductsPrice(array $idArr){
    $placeholder = [];
    foreach ($idArr as $id){
      $placeholder[] = '?';
    }
    $placeholder = implode(', ', $placeholder);
    $sql = "SELECT id AS product_id, price FROM {$this->getTableName()} WHERE id IN ({$placeholder})";
    return $this->db->queryAll($sql, $idArr);
  }
  
}