
CREATE TABLE contacts (
     id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     name  VARCHAR(30) NOT NULL,
     kana  VARCHAR(30) NOT NULL,
     tel   VARCHAR(30),
     email VARCHAR(100)NOT NULL,
     inquiry  VARCHAR(100) NOT NULL
);