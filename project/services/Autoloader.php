<?php

namespace app\services;

class Autoloader
{
  
  public $expansion = '.php';
  
  public function loadClass($className) {
//    $pattern = '/^(app\\\)(.+)/';
//    $pattern = '/^(\w+\\\)(.+)/';
//    $replacement = ROOT_DIR . '\$2.php';
//    $fileClass = preg_replace($pattern, $replacement, $className);
    $fileClass = str_replace(['app\\', '\\'], [ROOT_DIR, DS], $className);
    $fileClass .= $this->expansion;
    if (file_exists($fileClass)) {
      include $fileClass;
    } else {
      echo 'Не найден файл класса';
    }
  }
}