Create database bookstore;
use bookstore;
CREATE TABLE IF NOT EXISTS books (
  id int not null auto_increment primary key,
  book_isbn varchar(20) NOT NULL,
  book_title varchar(60) NOT NULL,
  book_author varchar(60) NOT NULL,
  book_image varchar(40) NOT NULL,
  book_descr varchar(500),
  book_price decimal(6,2) NOT NULL,
  publisherid int(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS customers (
  customerid int not null auto_increment primary key,
  fname varchar(60) NOT NULL,
  lname varchar(60) NOT NULL,
  address varchar(80)  NOT NULL,
  city varchar(30)  NOT NULL,
  postal_code varchar(10)  NOT NULL,
  country varchar(60)  NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
  orderid int not null auto_increment primary key,
  customerid int NOT NULL,
  amount decimal(6,2) NOT NULL,
  date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ship_name char(60) NOT NULL,
  ship_address char(80) NOT NULL,
  ship_city char(30) NOT NULL,
  ship_zip_code char(10) NOT NULL,
  ship_country char(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS order_items (
  orderid int not null auto_increment primary key,
  book_isbn varchar(20) NOT NULL,
  item_price decimal(6,2) NOT NULL,
  quantity int NOT NULL
);

CREATE TABLE IF NOT EXISTS publisher (
  publisherid int not null auto_increment primary key,
  publisher_name varchar(60) NOT NULL
);
ALTER TABLE books
ADD book_qty int;





