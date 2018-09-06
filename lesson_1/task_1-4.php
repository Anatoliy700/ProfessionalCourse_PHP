<?php

class Product
{
  private $optionsSizes;
  private $optionsColors;
  
  public function __construct($optionsSizes, $optionsColors) {
    $this->optionsSizes = $optionsSizes;
    $this->optionsColors = $optionsColors;
  }
  
  public function get_optionsSizes() {
    return $this->optionsSizes;
  }
  
  public function get_optionsColors() {
    return $this->optionsColors;
  }
}

class Pants extends Product
{
  private $optionsHeight;
  
  public function __construct($optionsSizes, $optionsColors, $optionsHeight) {
    parent::__construct($optionsSizes, $optionsColors);
    $this->$optionsHeight = $optionsHeight;
  }
  
  public function get_optionsHeight() {
    return $this->optionsHeight;
  }
}

