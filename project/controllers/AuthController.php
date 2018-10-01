<?php

namespace app\controllers;


use app\base\App;
use app\services\exception\AuthException;
use app\services\Redirect;

class AuthController extends Controller
{
  public function actionIndex() {
    if ($this->isAuth()) {
      Redirect::go('/lk');
    }
    echo $this->render('auth');
  }
  
  public function actionIn() {
    $login = $this->request->getParams('login');
    $pass = $this->request->getParams('pass');
    if ($this->request->isPost() && $login && $pass) {
      try {
        App::call()->authorization->auth($login, $pass);
      } catch (AuthException $e) {
        echo $this->render('auth', ['message' => $e->getMessage()]);
        exit();
      }
    }
    Redirect::go('/auth');
  }
  
  public function actionOut() {
    App::call()->authorization->out();
    Redirect::go('/auth');
  }
}