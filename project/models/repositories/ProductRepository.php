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
  
}