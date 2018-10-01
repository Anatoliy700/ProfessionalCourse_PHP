<?php

namespace app\controllers;


use app\models\Order;
use app\services\exception\ControllerException;
use app\services\exception\RepositoryException;
use app\services\Redirect;

class OrderController extends Controller
{
  protected function actionIndex() {
    if ($this->isAuth()) {
      $orders = (new Order())->get();
      echo $this->render('orders', ['orders' => $orders]);
    } else {
      throw new ControllerException('Страница не найдена');
    }
  }
  
  protected function actionAdd() {
    if ($this->isAuth()) {
      (new Order())->add();
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
          $order = (new Order())->getDetails($id);
          echo $this->render('orderDetails', ['order' => $order]);
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
  
  protected function actionDelete() {
    if ($this->isAuth()) {
      $id = $this->request->getParams('id');
      if ($this->request->isPost() && $id) {
        (new Order())->remove($id);
      }
      Redirect::go();
    } else {
      throw new ControllerException('Страница не найдена');
    }
  }
}