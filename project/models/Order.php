<?php

namespace app\models;


use app\trains\TSetterGetter;

class Order extends DbModel
{
  use TSetterGetter;
  
  protected $id;
  private $user_id;
  private $products; //[[id, amount],[]]
  private $totalAmount;
  private $total_price;
  
  public static function getTableName(): string {
    return 'orders';
  }
}