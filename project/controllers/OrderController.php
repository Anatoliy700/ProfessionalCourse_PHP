<?php

namespace app\controllers;


use app\models\entities\Order;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\services\Redirect;

class OrderController extends Controller
{
  protected function actionIndex() {
    $orders = (new OrderRepository())->getAll();
    echo $this->render('orders', ['orders' => $orders]);
  }
  
  //TODO подумать над оптимизацией
  protected function actionAdd() {
    $userId = 1; //получаем id пользователя
    $cartRepository = new CartRepository();
    $cart = $cartRepository->getOne($userId);
    $order = new Order($cart, $userId);
    $products_id = $order->getProductsId();
    $productsPrice = (new ProductRepository())->getProductsPrice($products_id);
    $order->addTotal($productsPrice);
    (new OrderRepository())->save($order);
    $cartRepository->delete($cart);
    echo $this->render('message', ['message' => 'Заваказ успешно оформлен']);
  }
  
  protected function actionDetails() {
    $params = $this->request->getPostParams();
    if (!empty($params['id'])) {
      $orderRepository = new OrderRepository();
      $order = $orderRepository->getOne($params['id']);
      $products_id = $order->getProductsId();
      $products = (new ProductRepository())->getSelect($products_id);
      $orderArray = $order->toArray();
      foreach ($orderArray['products'] as &$productsItem) {
        foreach ($products as $product) {
          $product = $product->toArray();
          if ($product['id'] == $productsItem['product_id']) {
            $productsItem['details'] = $product;
//            $orderArray['total_price'] += $productsItem['amount'] * $product['price'];
//            $orderArray['total_amount'] += $productsItem['amount'];
          }
        }
      }
      echo $this->render('orderDetails', ['order' => $orderArray]);
    } else {
      Redirect::go();
    }
  }
  
  //TODO может промто передавать id без получения объекта
  protected function actionDelete() {
    $params = $this->request->getPostParams();
    if (!empty($params['id'])) {
      $orderRepository = new OrderRepository();
      $order = $orderRepository->getOne($params['id']);
      $orderRepository->delete($order);
    }
    Redirect::go();
  }
}