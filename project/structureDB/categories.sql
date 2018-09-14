CREATE TABLE categories
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  parent_id INT          NULL,
  title     VARCHAR(125) NOT NULL,
  CONSTRAINT category_category_id_fk
  FOREIGN KEY (parent_id) REFERENCES categories (id)
);

CREATE INDEX parent_id
  ON categories (parent_id);

CREATE INDEX title
  ON categories (title);

