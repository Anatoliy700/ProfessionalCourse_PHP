<?php

namespace app\controllers;


use app\models\Cart;
use app\services\Redirect;
use app\services\Session;

class CartController extends Controller
{
  /**
   *
   */
  public function actionIndex() {
    $cart = null;
    $session = new Session();
    if ($session->isProducts()) {
      $cart = new Cart($session->cart['products']);
    }
    echo $this->render('cart', ['cart' => $cart]);
  }
  
  /**
   *
   */
  public function actionAdd() {
    $this->addToCart(Session::ADD);
  }
  
  /**
   *
   */
  public function actionUpdate() {
    $this->addToCart(Session::UPDATE);
  }
  
  /**
   *
   */
  public function actionRemove() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['id']) {
      $product_id = (int)$_POST['id'];
      if ($product_id) {
        $session = new Session();
        $session->removeFromCart($product_id);
      }
    }
    Redirect::go();
  }
  
  /**
   * @param $type
   */
  private function addToCart($type) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['id']) {
      
      $product_id = (int)$_POST['id'];
      $product_amount = (int)$_POST['amount'] ?? 1;
      if ($product_id && $product_amount) {
        $session = new Session();
        $session->addToCart($product_id, $product_amount, $type);
      }
    }
    Redirect::go();
  }
}