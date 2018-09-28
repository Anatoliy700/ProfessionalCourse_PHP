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
  
  public function getOneByLogin($login){
    if($login){
      $sql = "SELECT * FROM {$this->getTableName()} WHERE login = :login";
      $response = $this->db->queryOne($sql, [':login' => $login], $this->getEntityClass());
      return $response;
    }
  }
}