<?php

namespace app\models\entities;


use app\models\repositories\ProductRepository;
use app\trains\TSetterGetter;

class Cart extends DataEntity
{
  use TSetterGetter;
  
  const ADD = false;
  const UPDATE = true;
  protected $id;
  private $products = []; //[[id, amount],[]]
  private $totalPrice = 0;
  private $totalAmount = 0;
  
  /**
   * Cart constructor.
   * @param null $data []
   */
  public function __construct($data = null) {
    $this->products = $data['products'];
//    $this->totalPrice = $data['totalPrice'];
//    $this->totalAmount = $data['totalAmount'];
    $this->getData();
  }
  
  private function getData() {
    if (count($this->products)) {
      $arrId = [];
      foreach ($this->products as $product) {
        if ($product['id'] !== null) {
          $arrId[] = $product['id'];
        }
      }
      $products = (new ProductRepository())->getSelect($arrId);
      
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
  }
  
  public function add($params, $type) {
    $id = (int)$params['id'];
    $amount = (int)$params['amount'];
    
    if ($id && $amount) {
      $arrKey = false;
      //если в корзине уже есть товар
      if ($this->products) {
        foreach ($this->products as $key => $item) {
          //проверяем нет ли уже добавляемого товара в карзине и если есть то только увеличиваем количество
          if ($item['id'] == $id) {
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
        $this->products[] = ['id' => $id, 'amount' => $amount];
      }
    }
  }
  
  public function remove($params){
    $id = (int)$params['id'];
    foreach ($this->products as $key => $item) {
      if ($item['id'] === $id) {
        array_splice($this->products, $key, 1);
        break;
      }
    }
  }
  
  public function toArray(): array {
    return [
      'products' => $this->products,
      'totalPrice' => $this->totalPrice,
      'totalAmount' => $this->totalAmount
    ];
  }
  
}