CREATE TABLE users
(
  id         INT AUTO_INCREMENT
    PRIMARY KEY,
  first_name VARCHAR(75)  NOT NULL,
  last_name  VARCHAR(70)  NOT NULL,
  login      VARCHAR(70)  NOT NULL,
  password   VARCHAR(255) NOT NULL,
  CONSTRAINT login
  UNIQUE (login)
);
CREATE INDEX first_name
  ON users (first_name);
CREATE INDEX last_name
  ON users (last_name);
CREATE INDEX password
  ON users (password);
