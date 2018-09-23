<?php

namespace app\models\entities;


abstract class DataEntity
{
  protected $updateProp = [];
  
  /**
   * @return array
   */
  public function getUpdateProp(): array {
    return $this->updateProp;
  }
  
  
  
  /**
   * @param $name
   * @return mixed
   */
  public function getProp($name) {
    return $this->$name;
  }
  
}