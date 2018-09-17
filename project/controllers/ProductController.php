<?php

namespace app\controllers;

use app\models\Product;
use app\services\Redirect;

class ProductController extends Controller
{
  /**
   *
   */
  public function actionIndex() {
    $product = Product::getAll();
    echo $this->render('catalog', ['products' => $product]);
  }
  
  /**
   *
   */
  public function actionCard() {
//    $this->useLayout = false;
    if ($_GET['id']) {
      $id = $_GET['id'];
      $product = Product::getOne($id);
      echo $this->render('card', ['product' => $product]);
    }else{
      Redirect::go();
    }
  }
}