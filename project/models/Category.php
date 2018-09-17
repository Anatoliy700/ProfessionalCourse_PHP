<?php

namespace app\models;


use app\trains\TSetterGetter;

class Category extends DbModel
{
  use TSetterGetter;
  
  protected $id;
  private $parent_id;
  private $title;
  private $url;
  
  public static function getTableName(): string {
    return 'categories';
  }
}