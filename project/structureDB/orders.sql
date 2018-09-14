CREATE TABLE orders
(
  id          INT AUTO_INCREMENT
    PRIMARY KEY,
  user_id     INT     NOT NULL,
  total_price INT(50) NOT NULL,
  CONSTRAINT orders_users_id_fk
  FOREIGN KEY (user_id) REFERENCES users (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE INDEX orders_total_price_index
  ON orders (total_price);

CREATE INDEX orders_user_id_index
  ON orders (user_id);

