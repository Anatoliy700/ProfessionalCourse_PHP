<?php

namespace app\controllers;


use app\base\App;
use app\services\Redirect;

class LkController extends Controller
{
  public function actionIndex() {
    $auth = App::call()->authorization;
    if ($auth->isAuth()) {
      $user = $auth->getUserSession();
      echo $this->render('lk', ['user' => $user]);
    } else {
      Redirect::go('auth');
    }
  }
}