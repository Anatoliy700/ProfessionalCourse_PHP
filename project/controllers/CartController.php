<?php

namespace app\controllers;


use app\models\entities\Cart;
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\services\Redirect;

class CartController extends Controller
{
  /**
   *
   */
  public function actionIndex() {
    $user_id = 1; //получаем id пользователя, он равен id корзины
    $cart = (new CartRepository())->getOne($user_id);
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
    echo $this->render('cart', ['cart' => count($cartArray['products']) ? $cartArray : null]);
  }
  
  /**
   *
   */
  public function actionAdd() {
    $this->addToCart(Cart::ADD);
    Redirect::go();
  }
  
  /**
   *
   */
  public function actionUpdate() {
    $this->addToCart(Cart::UPDATE);
    Redirect::go();
  }
  
  //TODO убрать дублирование, подумать над оптимизацией
  
  /**
   *
   */
  public function actionRemove() {
    $params = $this->request->getPostParams();
    if (isset($params['id'])) {
      $cartRepository = new CartRepository();
      $cart = $cartRepository->getOne(1);
      $cart->remove($params);
      $cartRepository->save($cart);
    }
    Redirect::go();
  }
  
  /**
   * @param $type
   */
  private function addToCart($type) {
    $params = $this->request->getPostParams();
    if (isset($params['id'])) {
      $cartRepository = new CartRepository();
      $cart = $cartRepository->getOne(1);
      $cart->add($params, $type);
      $cartRepository->save($cart);
    }
  }
}