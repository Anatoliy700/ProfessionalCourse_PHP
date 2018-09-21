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
//    $this->useLayout = false;
    $product = Product::getAll();
//    echo $this->render('catalog', ['products' => $product]);
    echo $this->render('twig_catalog.html', ['products' => $product]);
  }
  
  /**
   *
   */
  public function actionCard() {
//    $this->useLayout = false;
    if ($_GET['id']) {
      $id = $_GET['id'];
      $product = Product::getOne($id);
      echo $this->render('twig_card.html', ['product' => $product]);
    } else {
      Redirect::go();
    }
  }
}