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
   * @param $first_name
   * @param $last_name
   * @param $login
   * @param $password
   */
  public function __construct($first_name = null, $last_name = null, $login = null, $password = null) {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->login = $login;
    $this->password = $password;
  }
}