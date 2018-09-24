<?php

namespace app\models\entities;


use app\trains\TSetterGetter;

class Product extends DataEntity
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
    $this->title = $name;
    $this->description = $description;
    $this->price = $price;
    $this->producer = $producer;
    $this->category_id = $category_id;
    $this->path = $path;
  }
  
  /**
   * @return array
   */
  public function toArray(): array {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'description' => $this->description,
      'price' => $this->price,
      'producer' => $this->producer,
      'category_id' => $this->category_id,
      'path' => $this->path
    ];
  }
  
  
}