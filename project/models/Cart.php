<?php

namespace app\models;


use app\trains\TSetterGetter;

class Cart extends DbModel
{
  use TSetterGetter;
  
  protected $id;
  private $products;
  private $totalPrice = 0;
  private $totalAmount = 0;
  
  /**
   * Cart constructor.
   * @param $totalAmount
   * @param $totalPrice
   * @param $products
   */
  public function __construct($products = null, $totalPrice = null, $totalAmount = null) {
    parent::__construct();
    $this->products = $products;
    $this->totalPrice = $totalPrice;
    $this->totalAmount = $totalAmount;
    $this->getData();
  }
  
  private function getData() {
    $arrId = [];
    foreach ($this->products as $product) {
      if ($product['id'] !== null) {
        $arrId[] = $product['id'];
      }
    }
    $products = Product::getSelect($arrId);
    
    foreach ($this->products as &$cartItem) {
      foreach ($products as $product) {
        if ($product->id == $cartItem['id']) {
          $cartItem['details'] = $product;
          $this->totalPrice += $cartItem['amount'] * $product->price;
          $this->totalAmount += $cartItem['amount'];
        }
      }
    }
  }
  
  
  public static function getTableName(): string {
    return 'cars';
  }
}