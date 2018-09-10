<?php

namespace app\models;


class Category extends Model
{
  public $id;
  public $parentId;
  public $title;
  public $url;
  
  public function getTableName(): string {
    return 'categories';
  }
}