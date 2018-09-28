<?php

namespace app\models\repositories;


use app\models\entities\DataEntity;
use app\models\entities\Order;
use app\services\exception\RepositoryException;

class OrderRepository extends Repository
{
  protected function getTableName(): string {
    return 'orders';
  }
  
  protected function getEntityClass() {
    return Order::class;
  }
  
  public function getOne(int $id): DataEntity {
    $tableName = $this->getTableName();
    $sql = "SELECT  o.id,
                    o.user_id,
                    o.total_price,
                    o.total_amount,
                    s.name AS status
            FROM {$tableName} AS o
            LEFT JOIN order_statuses AS s ON s.id = o.status_id
            WHERE o.id = :id";
    $order = $this->db->queryOne($sql, [':id' => $id], $this->getEntityClass());
//    return $order;
    if ($order instanceof DataEntity) {
      $order->products = $this->getOrderProducts($order->id);
      return $order;
    } elseif ($this->getEntityClass() == Order::class) {
      throw new RepositoryException('Заказ не найден');
    } else {
      throw new \Exception();
    }
  }
  
  public function getAll(): array {
    $tableName = $this->getTableName();
    $sql = "SELECT  o.id,
                    o.user_id,
                    o.total_price,
                    o.total_amount,
                    s.name AS status
            FROM {$tableName} AS o
            LEFT JOIN order_statuses AS s ON s.id = o.status_id";
    return $this->db->queryAll($sql, [], $this->getEntityClass());
  }
  
  private function getOrderProducts($orderId) {
    $sql = "SELECT product_id, amount FROM order_products WHERE order_id = :id";
    return $this->db->queryAll($sql, [':id' => $orderId]);
  }
  
  //TODO добавить проверку на ошибки
  protected function insert(DataEntity $entity) {
    parent::insert($entity);
    if (!is_null($entity->id)) {
      foreach ($entity->products as $value) {
        $params[] = [
          ':order_id' => $entity->id,
          ':product_id' => $value['product_id'],
          ':amount' => $value['amount']
        ];
      }
      $columns = "`order_id`, `product_id`, `amount`";
      $placeholders = implode(", ", array_keys($params[0]));
      $sql = "INSERT INTO `order_products` ({$columns}) VALUES ($placeholders)";
      $this->db->beginTransaction();
      foreach ($params as $param) {
        $this->db->execute($sql, $param);
      }
      $this->db->commit();
    }
  }
}