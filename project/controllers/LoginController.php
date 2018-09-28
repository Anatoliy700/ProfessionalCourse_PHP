<?php

namespace app\controllers;


use app\models\entities\User;
use app\models\repositories\UserDbRepository;
use app\models\repositories\UserSessionRepository;
use app\services\Redirect;

class LoginController extends Controller
{
  public function actionIndex() {
    if ((new UserSessionRepository())->isAuth()) {
      Redirect::go('/product');
    }
    echo $this->render('login');
  }
  
  public function actionIn() {
    $login = $this->request->getParams('login');
    $pass = $this->request->getParams('pass');
    if ($this->request->isPost() && $login && $pass) {
      $user = (new UserDbRepository())->getOneByLogin($login);
      if ($user->checkPassword($pass)) {
        $userSessionRepository = new UserSessionRepository();
        $userSessionRepository->save($user);
      }
      Redirect::go();
    }
  }
}