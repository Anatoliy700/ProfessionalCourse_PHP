<?php

namespace app\models\repositories;


use app\models\entities\User;

class UserDbRepository extends Repository
{
  protected function getTableName(): string {
    return 'users';
  }
  
  protected function getEntityClass() {
    return User::class;
  }
  
  public function getUserByLogin($login) {
    if ($login) {
      $sql = "SELECT * FROM {$this->getTableName()} WHERE login = :login";
      return $this->db->queryOne($sql, [':login' => $login], $this->getEntityClass());
    }
  }
}