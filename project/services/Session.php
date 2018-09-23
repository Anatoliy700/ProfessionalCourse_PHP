<?php

namespace app\services;


class Session
{
  private $objectData;
  private $objectName;
  
  /**
   * Session constructor.
   * @param $objectName
   */
  public function __construct($objectName) {
    $this->objectName = $objectName;
  }
  
  /**
   *
   */
  public function getData() {
    return $_SESSION[$this->objectName] ?? [];
  }
  
  /**
   * @param $id
   */
  public function removeFromCart($id) {
    foreach ($this->objectData['products'] as $key => $item) {
      if ($item['id'] === $id) {
        array_splice($this->objectData['products'], $key, 1);
        break;
      }
    }
    $this->save('cart');
  }
  
  /**
   * @param $data
   */
  public function save($data) {
    $_SESSION[$this->objectName] = $data;
  }
}