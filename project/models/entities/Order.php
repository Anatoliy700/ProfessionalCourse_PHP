<?php

namespace app\models\entities;


use app\trains\TSetterGetter;

class Order extends DataEntity
{
  use TSetterGetter;
  
  protected $id;
  private $user_id;
  protected $products; //[[product_id, amount],[]]
  private $total_amount = 0;
  private $total_price = 0;
  protected $status;
  
  /**
   * Order constructor.
   * @param null $cart
   * @param null $userId
   */
  public function __construct($cart = null, $userId = null) {
    $this->user_id = $userId;
    $this->products = $cart->products;
    $this->total_amount = $cart->totalAmount;
    $this->total_price = $cart->totalPrice;
  }
  
  /**
   * @param array $productsPrice
   */
  public function addTotal(array $productsPrice) {
    foreach ($this->products as $product) {
      foreach ($productsPrice as $item) {
        if ($product['product_id'] == $item['product_id']) {
          $this->total_amount += $product['amount'];
          $this->total_price += $product['amount'] * $item['price'];
        }
      }
    }
  }
  
  /**
   * @return array
   */
  public function toArray(): array {
    return [
      'id' => $this->id,
      'user_id' => $this->user_id,
      'products' => $this->products,
      'total_amount' => $this->total_amount,
      'total_price' => $this->total_price,
      'status' => $this->status
    ];
  }
  
  public function getProductsId() {
    $productsId = [];
    if (!empty($this->products)) {
      foreach ($this->products as $product) {
        $productsId[] = $product['product_id'];
      }
    }
    return $productsId;
  }
  
}