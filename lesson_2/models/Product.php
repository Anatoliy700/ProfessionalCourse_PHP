<?php

namespace less_2\models;



abstract class Product
{
  public $name;
  public $description;
  protected $costPrice; // себестоимость
  protected $price;
  public $unit; //единица идмерения товара(штуки, кг и т.д.)
  
  public function getPrice(int $amount): int {
    return $this->price * $amount;
  }
  
  public function getProfit(int $amount) {
    return $this->getPrice($amount) - $this->costPrice;
  }
}