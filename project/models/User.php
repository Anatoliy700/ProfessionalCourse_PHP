<?php

namespace app\models;


class User extends Model
{
  public $id;
  public $first_name;
  public $last_name;
  public $login;
  public $password;
  
  public function getTableName(): string {
    return 'users';
  }
  
  public function getWhereColumnName(): string {
    return 'login';
  }
}