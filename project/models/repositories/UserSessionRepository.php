<?php

namespace app\models\repositories;


use app\models\entities\User;

class UserSessionRepository extends SessionRepository
{
  protected function getTableName(): string {
    return 'user';
  }
  
  protected function getEntityClass() {
    return User::class;
  }
  
  public function isAuth(){
    return (bool)$this->get();
  }
}