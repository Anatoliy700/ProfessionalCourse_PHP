<div class="wrap-lk">
  <div class="wrap_orders-lk">
    <?php if ($orders): ?>
      <h3>Ваши заказы</h3>
      <div id="orders" class="orders-lk">
        <?php foreach ($orders as $order): ?>
          <div class="order-lk">
            <div>
              <p>Номер заказа</p>
              <p><?= $order->id ?></p>
            </div>
            <div>
              <p>Товаров в заказе</p>
              <p><?= $order->total_amount ?></p>
            </div>
            <div>
              <p>Стоимость заказа</p>
              <p><?= $order->total_price ?> руб.</p>
            </div>
            <div>
              <p>Статус заказа</p>
              <p><?= $order->status ?></p>
            </div>
            <div>
              <form action="/order/delete" method="post">
                <input type="hidden" name="id" value="<?= $order->id ?>">
                <button type="submit">Отменить заказ</button>
                <button style="display: block; margin-top: 10px" formaction="/order/details" type="submit">
                  Посмотреть заказ
                </button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <h3>У вас нет заказов</h3>
    <?php endif; ?>
  </div>
</div>