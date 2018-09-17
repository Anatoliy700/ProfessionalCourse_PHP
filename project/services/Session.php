<?php

namespace app\services;


class Session
{
  const UPDATE = true;
  const ADD = false;
  public $cart;
  
  /**
   * Session constructor.
   */
  public function __construct() {
    $this->getCart();
  }
  
  /**
   *
   */
  protected function getCart() {
    $this->cart = $_SESSION['cart'] ?? [];
  }
  
  /**
   * @return bool
   */
  public function isProducts() {
    return isset($this->cart['products']) && count($this->cart['products']) > 0;
  }
  
  /**
   * @param $id
   * @param $amount
   * @param null $update
   */
  public function addToCart($id, $amount, $update) {
    
    $arrKey = false;
    
    //если в корзине уже есть товар
    if (isset($this->cart['products'])) {
      foreach ($this->cart['products'] as $key => $item) {
        //проверяем нет ли уже добавляемого товара в карзине и если есть то только увеличиваем количество
        if ($item['id'] == $id) {
          $arrKey = $key;
          break;
        }
      }
    }
    //если добавляемые товар уже присутсвует в карзине
    if ($arrKey !== false) {
      
      if ($update === static::UPDATE) {
        $this->cart['products'][$arrKey]['amount'] = $amount;
      } else {
        $this->cart['products'][$arrKey]['amount'] += $amount;
      }
      //если добавляемые товар не присутсвует в карзине
    } else {
      $this->cart['products'][] = ['id' => $id, 'amount' => $amount];
    }
    $this->save('cart');
  }
  
  public function removeFromCart($id) {
    foreach ($this->cart['products'] as $key => $item) {
      if ($item['id'] === $id) {
        array_splice($this->cart['products'], $key, 1);
        break;
      }
    }
    $this->save('cart');
  }
  
  /**
   * @param $param
   */
  private function save($param) {
    $_SESSION[$param] = $this->$param;
  }
}