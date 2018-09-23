<?php

namespace app\controllers;


use app\models\entities\Cart;
use app\models\repositories\CartRepository;
use app\services\Redirect;

class CartController extends Controller
{
  /**
   *
   */
  public function actionIndex() {
    $cart = (new CartRepository())->getOne(1);
    echo $this->render('cart', ['cart' => count($cart->getProp('products')) ? $cart : null]);
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