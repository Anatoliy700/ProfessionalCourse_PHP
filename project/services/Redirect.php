<?php

namespace app\services;


class Redirect
{
  private static function getDefaultUrl() {
    return $_SERVER['HTTP_REFERER'];
  }
  
  /**
   * производит редирект на переданный URL или на URL по default
   * @param $url {url} URL для редиректа
   */
  public static function go($url = null) {
    if (is_null($url)) {
      $url = static::getDefaultUrl();
    }
    header("Location: {$url}");
  }
}