<?php

namespace app\models;


class Order extends Model
{
  public $orderId;
  public $products; //[[id, amount],[]]
  public $totalAmount;
  public $totalPrice;
  
  public function getTableName(): string {
    return 'orders';
  }
}