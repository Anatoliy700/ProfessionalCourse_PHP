<?php

namespace app\interfaces;


use app\models\Model;

interface IModel
{
  public function getOne(int $id): Model;
  
  public function getAll(): array;
  
  public function getTableName(): string;
  
  public function getWhereColumnName(): string;
}