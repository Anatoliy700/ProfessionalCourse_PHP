<?php

namespace app\models\repositories;


use app\models\entities\User;

class UserRepository extends Repository
{
  protected function getTableName(): string {
    return 'users';
  }
  
  protected function getEntityClass() {
    return User::class;
  }
  
}