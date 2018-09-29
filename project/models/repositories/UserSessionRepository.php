<?php

namespace app\models\repositories;


use app\models\entities\DataEntity;
use app\models\entities\User;

class UserSessionRepository extends SessionRepository
{
  protected function getEntityClass() {
    return User::class;
  }
  
  public function getUser(): DataEntity {
    $reflectionClass = new \ReflectionClass($this->getEntityClass());
    return $reflectionClass->newInstanceArgs($this->get());
  }
}