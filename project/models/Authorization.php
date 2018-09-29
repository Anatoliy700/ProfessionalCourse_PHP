<?php

namespace app\models;


use app\models\entities\User;
use app\models\repositories\UserSessionRepository;
use app\models\repositories\UserDbRepository;
use app\services\exception\AuthException;

class Authorization
{
  public function auth($login, $pass) {
    $user = (new UserDbRepository())->getUserByLogin($login);
    if ($user) {
      if ($user->checkPassword($pass)) {
        $sessionRepository = new UserSessionRepository();
        $sessionRepository->set($user);
      } else {
        throw new AuthException('Не верный пароль', 2);
      }
    } else {
      throw new AuthException('Не верный логин', 1);
    }
  }
  
  public function out() {
    (new UserSessionRepository())->set();
  }
  
  public function isAuth() {
    return (bool)(new UserSessionRepository())->get();
  }
  
  public function getUserSession() {
    if ($this->isAuth()) {
      return (new UserSessionRepository())->getUser();
    }
    return null;
  }
  
  public function register($params) {
    $user = new User(null, $params['firstName'], $params['lastName'], $params['login'], $params['pass']);
    (new UserDbRepository())->save($user);
  }
  
}