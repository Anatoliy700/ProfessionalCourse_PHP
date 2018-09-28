<?php

namespace app\services;


class Session
{
  private $objectName;
  
  /**
   * Session constructor.
   * @param $objectName
   */
  public function __construct($objectName) {
    if (!session_id()) {
      session_start();
    }
    $this->objectName = $objectName;
  }
  
  /**
   *
   */
  public function getData() {
    return $_SESSION[$this->objectName] ?? [];
  }
  
  /**
   * @param $data
   */
  public function save($data) {
    $_SESSION[$this->objectName] = $data;
  }
}