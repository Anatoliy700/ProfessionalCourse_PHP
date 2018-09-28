<?php

namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\exception\RepositoryException;
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
    $id = $this->request->getParams('id');
    if ($this->request->isGet() && $id) {
      try {
        $product = (new ProductRepository())->getOne($id);
        echo $this->render('card', ['product' => $product]);
      } catch (RepositoryException $e) {
        echo $this->render('404', ['message' => $e->getMessage()]);
      }
    } else {
      Redirect::go();
    }
  }
}