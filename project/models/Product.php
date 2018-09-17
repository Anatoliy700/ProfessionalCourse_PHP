<?php

namespace app\models;


use app\trains\TSetterGetter;

class Product extends DbModel
{
  use TSetterGetter;
  
  protected $id;
  private $title;
  private $description;
  private $price;
  private $producer;
  private $category_id;
  private $path;
  
  /**
   * Product constructor.
   * @param $name
   * @param $description
   * @param $price
   * @param $producer
   * @param $category_id
   * @param $path
   */
  public function __construct($name = null, $description = null, $price = null, $producer = null, $category_id = null, $path = null) {
    parent::__construct();
    $this->title = $name;
    $this->description = $description;
    $this->price = $price;
    $this->producer = $producer;
    $this->category_id = $category_id;
    $this->path = $path;
  }
  
  public static function getTableName(): string {
    return 'products';
  }
}