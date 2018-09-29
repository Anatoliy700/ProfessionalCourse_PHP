<?php

namespace app\services\exception;

class RepositoryException extends \Exception
{
  protected $param;
  
  /**
   * RepositoryException constructor.
   */
  public function __construct($message, $code, $param) {
    parent::__construct($message, $code);
    $this->param = $param;
  }
  
  public function getParam() {
    return $this->param;
  }
}

class ControllerException extends \Exception
{
}

class AuthException extends \Exception
{
}