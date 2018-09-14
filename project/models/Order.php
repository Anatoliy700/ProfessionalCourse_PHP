<?php

namespace app\models;


class Order extends Model
{
  public $id;
  public $user_id;
  public $products; //[[id, amount],[]]
  public $totalAmount;
  public $total_price;
  
  public function getTableName(): string {
    return 'orders';
  }
  
  public function getWhereColumnName(): string {
    return 'id';
  }
}