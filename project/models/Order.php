<?php

namespace app\models;


use app\base\App;
use app\models\entities\Order as OrderEntity;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;

class Order
{
  public function get() {
    $user = App::call()->authorization->getUserSession();
    return (new OrderRepository())->getAll($user->getId());
  }
  
  public function add() {
    $user = App::call()->authorization->getUserSession();
    $userId = $user->getId(); //получаем id пользователя
    $cartRepository = new CartRepository();
    $cart = $cartRepository->getOne($userId);
    $order = new OrderEntity($cart, $userId);
    $products_id = $order->getProductsId();
    $productsPrice = (new ProductRepository())->getProductsPrice($products_id);
    $order->addTotal($productsPrice);
    (new OrderRepository())->save($order);
    $cartRepository->delete($cart);
  }
  
  public function getDetails($id) {
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
        }
      }
    }
    return $orderArray;
  }
  
  public function remove($id) {
    $orderRepository = new OrderRepository();
    $order = $orderRepository->getOne($id);
    $orderRepository->delete($order);
  }
}