<div class="wrap-cart">
  <?php if ($cart): ?>
    <h1>Корзина</h1>
    <div class="wrap-cart-products">
      <?php foreach ($cart['products'] as $product): ?>
        <div class="cart-product">
          <h3><?= $product['details']['title'] ?></h3>
          <div>
            <img src="/img/min/<?= $product['details']['path'] ?>.jpg" alt="<?= $product['details']['path'] ?>">
          </div>
          <form id="cart_<?= $product['product_id'] ?>" action="/cart/update" method="post">
            <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
            <input type="hidden" name="price" value="<?= $product['details']['price'] ?>">
            <input type="number" name="amount" min="1" value="<?= $product['amount'] ?>" required>
            <input type="submit" value="Изменить количество">
          </form>
          <div class="cart-product-total-price">
            Стоимость: <?= $product['amount'] * $product['details']['price'] ?> руб.
          </div>
          <input form="cart_<?= $product['product_id'] ?>" formaction="/cart/remove" type="submit"
                 value="Удалить товар">
        </div>
      <?php endforeach; ?>
      <p>Общая стоимость: <?= $cart['totalPrice'] ?> руб.</p>
    </div>
    <form method="post">
      <input formaction="/order/add" type="submit" value="Оформить заказ">
    </form>
  <?php elseif ($message): ?>
    <h2><?= $message ?></h2>
  <?php else: ?>
    <h2>Ваша карзина пуста</h2>
  <?php endif; ?>
</div>

