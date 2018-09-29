<?php

namespace app\trains;


trait TSetterGetter
{
  
  public function __get($name) {
    return $this->$name;
  }
  
  public function __set($name, $value) {
    if ($name == 'id') {
      throw new \Error('Cannot access protected property');
    } else {
      $this->$name = $value;
      $this->updateProp[] = $name;
    }
  }
  
}