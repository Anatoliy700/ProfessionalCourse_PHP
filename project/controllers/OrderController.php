<?php

namespace app\controllers;


use app\base\App;
use app\models\entities\Order;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\services\exception\ControllerException;
use app\services\exception\RepositoryException;
use app\services\Redirect;

class OrderController extends Controller
{
  protected function actionIndex() {
    if ($this->isAuth()) {
      $user = App::call()->authorization->getUserSession();
      $orders = (new OrderRepository())->getAll($user->getId());
      echo $this->render('orders', ['orders' => $orders]);
    } else {
      throw new ControllerException('Страница не найдена');
    }
  }
  
  //TODO подумать над оптимизацией
  protected function actionAdd() {
    if ($this->isAuth()) {
      $user = App::call()->authorization->getUserSession();
      $userId = $user->getId(); //получаем id пользователя
      $cartRepository = new CartRepository();
      $cart = $cartRepository->getOne($userId);
      $order = new Order($cart, $userId);
      $products_id = $order->getProductsId();
      $productsPrice = (new ProductRepository())->getProductsPrice($products_id);
      $order->addTotal($productsPrice);
      (new OrderRepository())->save($order);
      $cartRepository->delete($cart);
      echo $this->render('message', ['message' => 'Заваказ успешно оформлен']);
    } else {
      throw new ControllerException('Страница не найдена');
    }
  }
  
  protected function actionDetails() {
    if ($this->isAuth()) {
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
    } else {
      throw new ControllerException('Страница не найдена');
    }
  }
  
  //TODO может промто передавать id без получения объекта
  protected function actionDelete() {
    if ($this->isAuth()) {
      $id = $this->request->getParams('id');
      if ($this->request->isPost() && $id) {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->getOne($id);
        $orderRepository->delete($order);
      }
      Redirect::go();
    } else {
      throw new ControllerException('Страница не найдена');
    }
  }
}