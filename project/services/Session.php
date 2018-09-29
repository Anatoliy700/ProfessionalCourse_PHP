<?php

namespace app\services;


class Session
{
  /**
   * Session constructor.
   */
  public function __construct() {
    session_start();
  }
  
  /**
   * @param $key
   * @return null
   */
  public function get($key) {
    return $_SESSION[$key] ?? null;
  }
  
  /**
   * @param $key
   * @param $data
   */
  public function set($key, $data) {
    $_SESSION[$key] = $data;
  }
}