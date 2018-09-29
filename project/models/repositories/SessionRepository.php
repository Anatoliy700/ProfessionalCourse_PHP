<?php

namespace app\models\repositories;


use app\base\App;
use app\models\entities\DataEntity;

abstract class SessionRepository
{
  
  abstract protected function getEntityClass();
  
  protected function objectName() {
    preg_match('#\w+$#iu', $this->getEntityClass(), $matches);
    return $matches[0] ? strtolower($matches[0]) : null;
  }
  
  public function get() {
    return App::call()->session->get($this->objectName()) ?? [];
  }
  
  public function set(DataEntity $entity = null) {
    App::call()->session->set($this->objectName(), $entity ? $entity->toArray() : null);
  }
}