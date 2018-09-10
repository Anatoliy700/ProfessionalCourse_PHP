<?php

namespace less_2\models;


class DigitalGoods extends Product
{
  public function getPrice(int $amount): int {
    return parent::getPrice($amount) / 2;
  }
}