<?php

namespace app\tests;


use app\models\entities\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
  public function testProduct() {
    $products = [
      'id' => 1,
      'amount' => 2
    ];
    $this->assertTrue(true);
    return $products;
  }
  
  /**
   * @depends testProduct
   */
  public function testAdd($product) {
    $cart = new Cart();
    $cart->add($product, Cart::ADD);
    $products = $cart->toArray()['products'];
    $this->assertCount(1, $products);
    $this->assertArraySubset(
      [
        'product_id' => $product['id'],
        'amount' => $product['amount']
      ], $products[0]);
    return $cart;
  }
  
  /**
   * @depends testProduct
   * @depends testAdd
   */
  public function testRemove($product, $cart) {
    $products = $cart->toArray()['products'];
    $this->assertArrayHasKey('product_id', $products[0]);
    $cart->remove($product['id']);
    $products = $cart->toArray()['products'];
    $this->assertCount(0, $products);
  }
}