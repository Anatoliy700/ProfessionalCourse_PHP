<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\Redirect;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller
{
  /**
   *
   */
  public function actionIndex() {
//    $this->useLayout = false;
    $products = (new ProductRepository())->getAll();
    echo $this->render('catalog', ['products' => $products]);
  }
  
  /**
   *
   */
  public function actionCard() {
//    $this->useLayout = false;
    if ($_GET['id']) {
      $id = $_GET['id'];
      $product = (new ProductRepository())->getOne($id);
      echo $this->render('card', ['product' => $product]);
    } else {
      Redirect::go();
    }
  }
}