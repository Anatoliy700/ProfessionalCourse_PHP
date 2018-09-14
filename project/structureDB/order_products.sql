CREATE TABLE order_products
(
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  product_id INT NOT NULL,
  order_id   INT NOT NULL,
  amount     INT NOT NULL,
  CONSTRAINT order_products_product_id_fk
  FOREIGN KEY (product_id) REFERENCES products (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT order_products_orders_id_fk
  FOREIGN KEY (order_id) REFERENCES orders (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE INDEX order_products_amount_index
  ON order_products (amount);

CREATE INDEX order_products_orders_id_fk
  ON order_products (order_id);

CREATE INDEX order_products_product_id_fk
  ON order_products (product_id);

