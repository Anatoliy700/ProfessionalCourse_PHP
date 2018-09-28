<?php

namespace app\controllers;


use app\models\entities\Order;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\services\exception\RepositoryException;
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
    $id = $this->request->getParams('id');
    if ($this->request->isGet() && $id) {
      try {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->getOne($id);
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
      } catch (RepositoryException $e) {
        echo $this->render('404', ['message' => $e->getMessage()]);
      }
    } else {
      Redirect::go();
    }
  }
  
  //TODO может промто передавать id без получения объекта
  protected function actionDelete() {
    $id = $this->request->getParams('id');
    if ($this->request->isPost() && $id) {
      $orderRepository = new OrderRepository();
      $order = $orderRepository->getOne($id);
      $orderRepository->delete($order);
    }
    Redirect::go();
  }
}