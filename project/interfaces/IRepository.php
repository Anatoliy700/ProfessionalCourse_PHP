<?php

namespace app\interfaces;


use app\models\entities\DataEntity;

interface IRepository
{
  public function getOne(int $id);
  
  public function getAll($param = null): array;
  
  public function getSelect($arrId): array;
  
  public function delete(DataEntity $entity);
  
  public function save(DataEntity $entity);
}