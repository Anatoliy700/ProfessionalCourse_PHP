<?php

namespace app\models;


class Product extends Model
{
  public $id;
  public $name;
  public $description;
  public $price;
  public $producer;
  public $category_id;
  
  public function getTableName(): string {
    return 'products';
  }
  
  public function getWhereColumnName(): string {
    return 'id';
  }
}