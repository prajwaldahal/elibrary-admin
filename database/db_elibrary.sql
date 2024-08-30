-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 12:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_elibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn_no` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn_no`, `title`, `author`, `category_id`, `price`, `cover_image`, `description`) VALUES
('978000000001', 'Book Title 1', 'Author 1', 1, '19.99', 'cover1.jpg', 'Description of Book 1'),
('978000000002', 'Book Title 2', 'Author 2', 2, '24.99', 'cover2.jpg', 'Description of Book 2'),
('978000000003', 'Book Title 3', 'Author 3', 3, '14.99', 'cover3.jpg', 'Description of Book 3'),
('978000000004', 'Book Title 4', 'Author 4', 4, '29.99', 'cover4.jpg', 'Description of Book 4'),
('978000000005', 'Book Title 5', 'Author 5', 5, '12.99', 'cover5.jpg', 'Description of Book 5'),
('978000000006', 'Book Title 6', 'Author 6', 6, '9.99', 'cover6.jpg', 'Description of Book 6'),
('978000000007', 'Book Title 7', 'Author 7', 7, '15.99', 'cover7.jpg', 'Description of Book 7'),
('978000000008', 'Book Title 8', 'Author 8', 8, '18.99', 'cover8.jpg', 'Description of Book 8'),
('978000000009', 'Book Title 9', 'Author 9', 9, '22.99', 'cover9.jpg', 'Description of Book 9'),
('978000000010', 'Book Title 10', 'Author 10', 10, '25.99', 'cover10.jpg', 'Description of Book 10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(6, 'Biography'),
(7, 'Children'),
(9, 'Fantasy'),
(2, 'Fiction'),
(5, 'History'),
(1, 'Mystery'),
(3, 'Non-Fiction'),
(10, 'Romance'),
(4, 'Science'),
(8, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `rental_transactions`
--

CREATE TABLE `rental_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isbn_no` varchar(13) DEFAULT NULL,
  `rental_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rented_books_history`
--

CREATE TABLE `rented_books_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isbn_no` varchar(13) DEFAULT NULL,
  `rented_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isbn_no` varchar(13) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `registration_date`, `last_login`) VALUES
(1224, 'user1@example.com', 'password1', 'User One', '2023-01-01', '2023-01-10 10:00:00'),
(1225, 'user2@example.com', 'password2', 'User Two', '2023-02-01', '2023-02-10 11:00:00'),
(1226, 'user3@example.com', 'password3', 'User Three', '2023-03-01', '2023-03-10 12:00:00'),
(1227, 'user4@example.com', 'password4', 'User Four', '2023-04-01', '2023-04-10 13:00:00'),
(1228, 'user5@example.com', 'password5', 'User Five', '2023-05-01', '2023-05-10 14:00:00'),
(1229, 'user6@example.com', 'password6', 'User Six', '2023-06-01', '2023-06-10 15:00:00'),
(1230, 'user7@example.com', 'password7', 'User Seven', '2023-07-01', '2023-07-10 16:00:00'),
(1231, 'user8@example.com', 'password8', 'User Eight', '2023-08-01', '2023-08-10 17:00:00'),
(1232, 'user9@example.com', 'password9', 'User Nine', '2023-09-01', '2023-09-10 18:00:00'),
(1233, 'user10@example.com', 'password10', 'User Ten', '2023-10-01', '2023-10-10 19:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn_no`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `rental_transactions`
--
ALTER TABLE `rental_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `isbn_no` (`isbn_no`);

--
-- Indexes for table `rented_books_history`
--
ALTER TABLE `rented_books_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `isbn_no` (`isbn_no`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn_no` (`isbn_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rental_transactions`
--
ALTER TABLE `rental_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rented_books_history`
--
ALTER TABLE `rented_books_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `rental_transactions`
--
ALTER TABLE `rental_transactions`
  ADD CONSTRAINT `rental_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rental_transactions_ibfk_2` FOREIGN KEY (`isbn_no`) REFERENCES `books` (`isbn_no`);

--
-- Constraints for table `rented_books_history`
--
ALTER TABLE `rented_books_history`
  ADD CONSTRAINT `rented_books_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rented_books_history_ibfk_2` FOREIGN KEY (`isbn_no`) REFERENCES `books` (`isbn_no`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`isbn_no`) REFERENCES `books` (`isbn_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
