<?php

namespace app\models\entities;


use app\trains\TSetterGetter;

class Cart extends DataEntity
{
  use TSetterGetter;
  
  const ADD = false;
  const UPDATE = true;
  protected $id;
  private $products = []; //[[product_id, amount],[]]
  private $total_price = 0;
  private $total_amount = 0;
  
  /**
   * Cart constructor.
   * @param array $products
   * @param int $total_price
   * @param int $total_amount
   */
  public function __construct(array $products = null, $total_price = null, $total_amount = null) {
    $this->products = $products;
    $this->total_price = $total_price;
    $this->total_amount = $total_amount;
  }
  
  
  
  
  /**
   * Cart constructor.
   * @param null $data []
   *//*
  public function __construct($data = null) {
    if (!empty($data)) {
      $this->products = $data['products'];
      $this->total_price = $data['total_price'];
      $this->total_amount = $data['total_amount'];
    }
  }*/
  
  /**
   * @param $params
   * @param $type
   */
  public function add($params, $type) {
    $id = (int)$params['id'];
    $amount = (int)$params['amount'];
    $price = (int)$params['price'];
    
    if ($id && $amount) {
      $arrKey = false;
      //если в корзине уже есть товар
      if ($this->products) {
        foreach ($this->products as $key => $item) {
          //проверяем нет ли уже добавляемого товара в карзине и если есть то только увеличиваем количество
          if ($item['product_id'] == $id) {
            $arrKey = $key;
            break;
          }
        }
      }
      //если добавляемые товар уже присутсвует в карзине
      if ($arrKey !== false) {
        
        if ($type === Cart::UPDATE) {
          $this->products[$arrKey]['amount'] = $amount;
        } else {
          $this->products[$arrKey]['amount'] += $amount;
        }
        //если добавляемые товар не присутсвует в карзине
      } else {
        $this->products[] = ['product_id' => $id, 'amount' => $amount, 'price' => $price];
      }
    }
  }
  
  /**
   * @param $id
   */
  public function remove($id) {
    $id = (int)$id;
    foreach ($this->products as $key => $item) {
      if ($item['product_id'] === $id) {
        array_splice($this->products, $key, 1);
        break;
      }
    }
  }
  
  /**
   * @return array
   */
  public function getProductsId() {
    $productsId = [];
    if (!empty($this->products)) {
      foreach ($this->products as $product) {
        $productsId[] = $product['product_id'];
      }
    }
    return $productsId;
  }
  
  /**
   * @return array
   */
  public function toArray(): array {
    return [
      'products' => $this->products,
      'total_price' => $this->total_price,
      'total_amount' => $this->total_amount
    ];
  }
  
}