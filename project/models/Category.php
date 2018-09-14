<?php

namespace app\models;


class Category extends Model
{
  public $id;
  public $parent_id;
  public $title;
  public $url;
  
  public function getTableName(): string {
    return 'categories';
  }
  
  public function getWhereColumnName(): string {
    return 'id';
  }
}