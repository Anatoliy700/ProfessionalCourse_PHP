<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 17.09.2018
 * Time: 19:52
 */

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