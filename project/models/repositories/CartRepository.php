<?php

namespace app\models\repositories;


use app\models\entities\Cart;
use app\models\entities\DataEntity;
use app\services\Session;

class CartRepository extends SessionRepository
{
  
  protected function getTableName(): string {
    return 'carts';
  }
  
  protected function getEntityClass() {
    return Cart::class;
  }
}