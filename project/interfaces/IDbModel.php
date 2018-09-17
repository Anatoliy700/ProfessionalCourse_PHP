<?php

namespace app\interfaces;


use app\models\DbModel;

interface IDbModel
{
  public static function getOne(int $id): DbModel;
  
  public static function getAll(): array;
  
  public static function getTableName(): string;
  
  public function __get($name);
  
  
  public function __set($name, $value);


//  public function getWhereColumnName(): string;
}