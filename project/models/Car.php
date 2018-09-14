<?php

namespace app\models;


class Car extends Model
{
  public $id;
  public $products;
  public $totalAmount;
  public $totalPrice;
  
  public function getTableName(): string {
    return 'cars';
  }
  
  public function getWhereColumnName(): string {
    return 'id';
  }
}