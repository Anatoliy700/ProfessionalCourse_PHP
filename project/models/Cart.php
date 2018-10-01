<?php

namespace app\models;


use app\interfaces\IRepository;
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;

class Cart
{
  /**
   * Определяем с каким репозиторием работаем
   * @return IRepository
   */
  protected function getCartRepository(): IRepository {
    return new CartRepository();
  }
  
  /**
   * Получаем и возвращаем userId, если того теребует репозиторий
   * @return int
   */
  protected function getUserId(): int {
    return 0;
  }
  
  public function get() {
    $cart = ($this->getCartRepository())->getOne($this->getUserId());
    $products_id = $cart->getProductsId();
    $cartArray = $cart->toArray();
    if (!empty($products_id)) {
      $products = (new ProductRepository())->getSelect($products_id);
      foreach ($cartArray['products'] as &$productsItem) {
        foreach ($products as $product) {
          $product = $product->toArray();
          if ($product['id'] == $productsItem['product_id']) {
            $productsItem['details'] = $product;
            $cartArray['totalPrice'] += $productsItem['amount'] * $product['price'];
            $cartArray['totalAmount'] += $productsItem['amount'];
          }
        }
      }
    }
    return $cartArray;
  }
  
  public function add($params, $type) {
    $cartRepository = $this->getCartRepository();
    $cart = $cartRepository->getOne($this->getUserId());
    $cart->add($params, $type);
    $cartRepository->save($cart);
  }
  
  public function remove($id) {
    $cartRepository = $this->getCartRepository();
    $cart = $cartRepository->getOne($this->getUserId());
    $cart->remove($id);
    $cartRepository->save($cart);
  }
}