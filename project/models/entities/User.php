<?php

namespace app\models\entities;


use app\trains\TSetterGetter;

class User extends DataEntity
{
  use TSetterGetter;
  
  protected $id;
  private $first_name;
  private $last_name;
  private $login;
  private $password;
  
  /**
   * User constructor.
   * @param $id
   * @param $first_name
   * @param $last_name
   * @param $login
   * @param $password
   */
  public function __construct($id = null, $first_name = null, $last_name = null, $login = null, $password = null) {
    $this->id = $id;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->login = $login;
    $this->password = $password;
  }
  
  
  public function checkPassword($pass){
    return password_verify($pass, $this->password);
  }
  
  public function toArray(): array {
    return [
      'id' => $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'login' => $this->login
    ];
  }
  
  
}