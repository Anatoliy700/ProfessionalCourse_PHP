<?php

namespace app\services;

class Autoloader
{
  public function loadClass($className) {
//    $pattern = '/^(app\\\)(.+)/';
    $pattern = '/^(\w+\\\)(.+)/';
    $replacement = ROOT_DIR . '\$2.php';
    $fileClass = preg_replace($pattern, $replacement, $className);
    if (file_exists($fileClass)) {
      include $fileClass;
    } else {
      echo 'Не найден файл класса';
    }
  }
}