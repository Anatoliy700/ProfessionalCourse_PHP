<?php

namespace app\controllers;


use app\base\App;
use app\services\exception\RepositoryException;
use app\services\Redirect;

class RegistrationController extends Controller
{
  public function actionIndex() {
    if ($this->isAuth()) {
      Redirect::go('/lk');
    } else {
      echo $this->render('registration');
    }
  }
  
  public function actionAdd() {
    $params = [
      'firstName' => $this->request->getParams('first-name'),
      'lastName' => $this->request->getParams('last-name'),
      'login' => $this->request->getParams('login'),
      'pass' => $this->request->getParams('pass')
    ];
    if ($this->request->isPost()
      && $params['firstName']
      && $params['lastName']
      && $params['login']
      && $params['pass']
    ) {
      try {
        App::call()->authorization->register($params);
        echo $this->render('message', ['message' => 'Вы успешно зарегистрировались']);
      } catch (RepositoryException $e) {
        if ($e->getCode() === 23000) {
          echo $this->render('registration', ['message' => 'Логин: ' . $e->getParam() . ' уже существует']);
        }
      }
    } else {
      Redirect::go('/registration');
    }
  }
}