<?php

namespace app\controllers;


use app\models\Cart;
use \app\models\entities\Cart as CartEntity;
use app\services\Redirect;

class CartController extends Controller
{
  /**
   *
   */
  public function actionIndex() {
    $cart = (new Cart())->get();
    echo $this->render('cart', ['cart' => count($cart['products']) ? $cart : null]);
  }
  
  /**
   *
   */
  public function actionAdd() {
    $this->addToCart(CartEntity::ADD);
    Redirect::go();
  }
  
  /**
   *
   */
  public function actionUpdate() {
    $this->addToCart(CartEntity::UPDATE);
    Redirect::go();
  }
  
  /**
   *
   */
  public function actionRemove() {
    $id = $this->request->getParams('id');
    if ($this->request->isPost() && $id) {
      (new Cart())->remove($id);
    }
    Redirect::go();
  }
  
  /**
   * @param $type
   */
  private function addToCart($type) {
    $params = [
      'id' => (int)$this->request->getParams('id'),
      'amount' => (int)$this->request->getParams('amount'),
      'price' => (int)$this->request->getParams('price')
    ];
    if ($this->request->isPost()
      && $params['id']
      && $params['amount']
      && $params['price']
    ) {
      (new Cart())->add($params, $type);
    }
  }
}