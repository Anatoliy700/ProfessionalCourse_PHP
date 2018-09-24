<div class="wrap-cart">
  <?php if ($order): ?>
    <h1>Заказ № <?= $order['id'] ?></h1>
    <h3>Статус заказа: <?= $order['status'] ?></h3>
    <div class="wrap-cart-products">
      <?php foreach ($order['products'] as $product): ?>
        <div class="cart-product">
          <h3><?= $product['details']['title'] ?></h3>
          <div>
            <img src="/img/min/<?= $product['details']['path'] ?>.jpg" alt="<?= $product['details']['path'] ?>">
          </div>
          <div>Количество: <?= $product['amount'] ?></div>
          <div class="cart-product-total-price">
            Стоимость: <?= $product['amount'] * $product['details']['price'] ?> руб.
          </div>
        </div>
      <?php endforeach; ?>
      <p>Общая стоимость: <?= $order['total_price'] ?> руб.</p>
    </div>
  <?php endif; ?>
</div>

