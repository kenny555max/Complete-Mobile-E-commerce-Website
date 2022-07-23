-- products
CREATE TABLE `users` (
    `id` int(11) not null PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(500) not null,
    `email` varchar(1000) not null,
    `password` varchar(1000) not null
) ENGINE=innoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (
    `item_id` int(11) NOT NULL,
    `item_brand` varchar(200) NOT NULL,
    `item_name` varchar(255) NOT NULL,
    `item_price` double(10,2) NOT NULL,
    `item_image` varchar(255) NOT NULL,
    `item_register` datetime DEFAULT NULL
) ENGINE=innoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products`(`item_id`, `item_brand`, `item_name`, `item_price`, `item_image`, `item_register`) VALUES
(1, 'Samsung', 'Samsung Galaxy 10', 152.00, 'img/nokia-5-black.png', '2021-03-08 11:09:16'),
(2, 'Redmi', 'Redmi Note 7', 122.00, 'img/nokia-5-blue.png', '2021-05-06 01:19:36'),
(3, 'Redmi', 'Redmi Note 6', 122.00, 'img/nokia-5-copper.png', '2021-05-06 01:19:36'),
(4, 'Redmi', 'Redmi Note 5', 122.00, 'img/nokia-5-silver.png', '2021-05-06 01:19:36'),
(5, 'Redmi', 'Redmi Note 4', 122.00, 'img/nokia-5-blue.png', '2021-05-06 01:19:36'),
(6, 'Redmi', 'Redmi Note 3', 122.00, 'img/nokia-5-copper.png', '2021-05-06 01:19:36'),
(7, 'Redmi', 'Redmi Note 8', 122.00, 'img/nokia-5-silver.png', '2021-05-06 01:19:36'),
(8, 'Redmi', 'Redmi Note 9', 122.00, 'img/nokia-5-blue.png', '2021-05-06 01:19:36'),
(9, 'Samsung', 'Samsung Galaxy s6', 152.00, 'img/nokia-5-black.png', '2021-03-08 12:49:16'),
(10, 'Apple', 'Apple iphone 13', 152.00, 'img/nokia-5-copper.png', '2021-03-08 10:39:16'),
(11, 'Apple', 'Apple iphone 10', 152.00, 'img/nokia-5-blue.png', '2021-03-08 10:09:16'),
(12, 'Samsung', 'Samsung Galaxy 10', 152.00, 'img/nokia-5-silver.png', '2021-03-08 12:09:16'),
(13, 'Samsung', 'Samsung Galaxy s6', 152.00, 'img/nokia-5-black.png', '2021-03-08 11:49:36'),
(14, 'Apple', 'Apple iphone 7', 152.00, 'img/nokia-5-blue.png', '2021-03-08 11:29:36'),
(15, 'Apple', 'Apple Mac book', 152.00, 'img/nokia-5-blue.png', '2021-03-08 11:39:26'),
(16, 'Samsung', 'Samsung Galaxy 10', 152.00, 'img/nokia-5-blue.png', '2021-03-08 11:19:16'),
(17, 'Samsung', 'Samsung Galaxy 10', 152.00, 'img/nokia-5-silver.png', '2021-03-08 11:29:16'),
(18, 'Samsung', 'Samsung Galaxy s10', 152.00, 'img/nokia-5-copper.png', '2021-03-08 11:39:16'),
(19, 'Apple', 'Apple iphone 12', 152.00, 'img/nokia-5-silver.png', '2021-03-08 11:02:16'),
(20, 'Apple', 'Apple iphone 513', 152.00, 'img/nokia-5-blue.png', '2021-03-08 11:03:36');

CREATE TABLE `cart` (
    `cart_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `item_id` int(11) NOT NULL
) ENGINE=innoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `wishlist` (
    `cart_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `item_id` int(11) NOT NULL
) ENGINE=innoDB DEFAULT CHARSET=utf8mb4;