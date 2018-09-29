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
   * @param $id
   */
  public function setId($id) {
    if ((int)$id) {
      $this->id = $id;
    }
    
  }
  
  
  /**
   * @param $name
   * @return mixed
   */
  public function getProp($name) {
    return $this->$name;
  }
  
  /**
   * @return array
   */
  abstract public function toArray(): array;
}