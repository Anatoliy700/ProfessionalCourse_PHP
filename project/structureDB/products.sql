CREATE TABLE products
(
  id          INT AUTO_INCREMENT
    PRIMARY KEY,
  title        VARCHAR(50)  NOT NULL,
  description VARCHAR(255) NOT NULL,
  price       INT          NOT NULL,
  producer    VARCHAR(125) NOT NULL,
  category_id INT          NOT NULL,
  CONSTRAINT product_category_id_fk
  FOREIGN KEY (category_id) REFERENCES categories (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);
CREATE INDEX product_category_id_fk
  ON products (category_id);
CREATE INDEX product_name_index
  ON products (title);
CREATE INDEX product_price_index
  ON products (price);
CREATE INDEX product_producer_index
  ON products (producer);
