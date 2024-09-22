-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 05:21 PM
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
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` int(11) NOT NULL,
  `notification_type` enum('info','warning','error') NOT NULL,
  `message` text NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn_no` varchar(13) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(20) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `cover_image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `added_on` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn_no`, `title`, `author`, `category_id`, `price`, `cover_image`, `description`, `added_on`, `is_deleted`) VALUES
('9780132350884', 'Clean Code', 'Robert C. Martin', 2, '29.99', './uploads/821590.jpg', 'A Handbook of Agile Software Craftsmanship', '2024-09-21 20:15:29', 0),
('9780134177304', 'Design Patterns', 'Erich Gamma', 2, '50.00', NULL, 'Elements of Reusable Object-Oriented Software', '2024-09-21 20:15:29', 0),
('9780134494165', 'The Clean Coder', 'Robert C. Martin', 2, '34.99', NULL, 'A Code of Conduct for Professional Programmers', '2024-09-21 20:15:29', 0),
('9780134685991', 'Effective Java', 'Joshua Bloch', 2, '45.00', NULL, 'A Programming Language Guide', '2024-09-21 20:15:29', 0),
('9780134757590', 'Java Concurrency in Practice', 'Brian Goetz', 2, '49.99', NULL, 'Build Multi-Threaded Applications', '2024-09-21 20:15:29', 0),
('9780136142510', 'Code Complete', 'Steve McConnell', 2, '39.99', NULL, 'A Practical Handbook of Software Construction', '2024-09-21 20:15:29', 0),
('9780201616224', 'The Pragmatic Programmer', 'Andrew Hunt', 2, '39.99', NULL, 'Your Journey To Mastery', '2024-09-21 20:15:29', 0),
('9780321573513', 'Refactoring', 'Martin Fowler', 2, '44.99', NULL, 'Improving the Design of Existing Code', '2024-09-21 20:15:29', 0),
('9781491946008', 'JavaScript: The Good Parts', 'Douglas Crockford', 2, '20.00', NULL, 'Unearthing the Excellence in JavaScript', '2024-09-21 20:15:29', 0),
('9781491950357', 'You Don\'t Know JS', 'Kyle Simpson', 2, '25.00', NULL, 'Scope & Closures', '2024-09-21 20:15:29', 0);

--
-- Triggers `books`
--
DELIMITER $$
CREATE TRIGGER `before_book_insert` BEFORE INSERT ON `books` FOR EACH ROW BEGIN
  -- Check if the isbn_no exists in the requestedbook table
  IF EXISTS (SELECT 1 FROM requestedbook WHERE isbn = NEW.isbn_no) THEN
    -- Update the is_deleted field to 1 in requestedbook if isbn matches
    UPDATE requestedbook
    SET is_deleted = 1
    WHERE isbn = NEW.isbn_no;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `is_deleted`) VALUES
(1, 'Fiction', 0),
(2, 'Non-Fiction', 0),
(3, 'Science', 0),
(4, 'History', 0),
(5, 'Fantasy', 0),
(6, 'Biography', 0),
(7, 'Mystery', 0),
(8, 'Romance', 0),
(9, 'Self-Help', 0),
(10, 'Cookbooks', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reading_progress`
--

CREATE TABLE `reading_progress` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `book_id` varchar(13) NOT NULL,
  `progress` int(11) NOT NULL,
  `last_read` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reading_progress`
--

INSERT INTO `reading_progress` (`id`, `user_id`, `book_id`, `progress`, `last_read`) VALUES
(1, '10001', '9780132350884', 50, '2024-09-21 20:15:29'),
(2, '10002', '9780201616224', 20, '2024-09-21 20:15:29'),
(3, '10003', '9780134685991', 75, '2024-09-21 20:15:29'),
(4, '10004', '9780134494165', 40, '2024-09-21 20:15:29'),
(5, '10005', '9780134757590', 10, '2024-09-21 20:15:29'),
(6, '10006', '9780134177304', 60, '2024-09-21 20:15:29'),
(7, '10007', '9781491950357', 30, '2024-09-21 20:15:29'),
(8, '10008', '9781491946008', 90, '2024-09-21 20:15:29'),
(9, '10009', '9780136142510', 20, '2024-09-21 20:15:29'),
(10, '10010', '9780321573513', 80, '2024-09-21 20:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `rental_transactions`
--

CREATE TABLE `rental_transactions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `isbn_no` varchar(13) DEFAULT NULL,
  `rental_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `rental_transactions`
--
DELIMITER $$
CREATE TRIGGER `after_insert_rental_transaction` AFTER INSERT ON `rental_transactions` FOR EACH ROW BEGIN
    DECLARE notification_message TEXT;
    
    SET notification_message = CONCAT('A book with ISBN ', NEW.isbn_no, ' has been rented by user ID ', NEW.user_id);
    
    INSERT INTO admin_notification (notification_type, message, user_id)
    VALUES ('info', notification_message, NEW.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_rental_transaction` BEFORE DELETE ON `rental_transactions` FOR EACH ROW BEGIN
    DECLARE notification_message TEXT;
    
    INSERT INTO rented_books_history (user_id, isbn_no, rented_date, expired_date, price)
    VALUES (OLD.user_id, OLD.isbn_no, OLD.rental_date, OLD.expiry_date, OLD.amount_paid);
    
    SET notification_message = CONCAT('Rental transaction for book ISBN ', OLD.isbn_no, ' has expired');

    INSERT INTO admin_notification (notification_type, message, user_id)
    VALUES ('info', notification_message, OLD.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rented_books_history`
--

CREATE TABLE `rented_books_history` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `isbn_no` varchar(13) DEFAULT NULL,
  `rented_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requestedbook`
--

CREATE TABLE `requestedbook` (
  `request_id` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `title` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requestedbook`
--

INSERT INTO `requestedbook` (`request_id`, `isbn`, `title`, `user_id`, `request_date`, `is_deleted`) VALUES
(1, '9780134685991', 'Effective Java', '10003', '2024-09-21 20:15:29', 0),
(2, '9780132350884', 'Clean Code', '10001', '2024-09-21 20:15:29', 0),
(3, '9780201616224', 'The Pragmatic Programmer', '10002', '2024-09-21 20:15:29', 0),
(4, '9780134494165', 'The Clean Coder', '10004', '2024-09-21 20:15:29', 0),
(5, '9780134757590', 'Java Concurrency in Practice', '10005', '2024-09-21 20:15:29', 0),
(6, '9780134177304', 'Design Patterns', '10006', '2024-09-21 20:15:29', 0),
(7, '9781491950357', 'You Don\'t Know JS', '10007', '2024-09-21 20:15:29', 0),
(8, '9781491946008', 'JavaScript: The Good Parts', '10008', '2024-09-21 20:15:29', 0),
(9, '9780136142510', 'Code Complete', '10009', '2024-09-21 20:15:29', 0),
(10, '9780321573513', 'Refactoring', '10010', '2024-09-21 20:15:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `isbn_no` varchar(13) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `isbn_no`, `rating`, `comment`, `review_date`) VALUES
(1, '10001', '9780132350884', 5, 'An essential read for all developers.', '2024-01-05'),
(2, '10002', '9780201616224', 4, 'Great insights into programming.', '2024-01-06'),
(3, '10003', '9780134685991', 5, 'Best Java book available.', '2024-01-07'),
(4, '10004', '9780134494165', 3, 'Good, but a bit repetitive.', '2024-01-08'),
(5, '10005', '9780134757590', 4, 'Very helpful for understanding concurrency.', '2024-01-09'),
(6, '10006', '9780134177304', 5, 'A must-read for every developer.', '2024-01-10'),
(7, '10007', '9781491950357', 5, 'JavaScript concepts explained well.', '2024-01-11'),
(8, '10008', '9781491946008', 4, 'A good introduction to JavaScript.', '2024-01-12'),
(9, '10009', '9780136142510', 5, 'Comprehensive coverage of software construction.', '2024-01-13'),
(10, '10010', '9780321573513', 4, 'Useful techniques for refactoring.', '2024-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
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
('10001', 'user1@example.com', 'hashed_password_1', 'User One', '2024-01-01', NULL),
('10002', 'user2@example.com', 'hashed_password_2', 'User Two', '2024-01-02', NULL),
('10003', 'user3@example.com', 'hashed_password_3', 'User Three', '2024-01-03', NULL),
('10004', 'user4@example.com', 'hashed_password_4', 'User Four', '2024-01-04', NULL),
('10005', 'user5@example.com', 'hashed_password_5', 'User Five', '2024-01-05', NULL),
('10006', 'user6@example.com', 'hashed_password_6', 'User Six', '2024-01-06', NULL),
('10007', 'user7@example.com', 'hashed_password_7', 'User Seven', '2024-01-07', NULL),
('10008', 'user8@example.com', 'hashed_password_8', 'User Eight', '2024-01-08', NULL),
('10009', 'user9@example.com', 'hashed_password_9', 'User Nine', '2024-01-09', NULL),
('10010', 'user10@example.com', 'hashed_password_10', 'User Ten', '2024-01-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `fcm_token` varchar(255) NOT NULL,
  `fcm_last_refreshed` timestamp NOT NULL DEFAULT current_timestamp(),
  `jwt_token` varchar(500) NOT NULL,
  `jwt_expiry` timestamp NOT NULL DEFAULT current_timestamp(),
  `jwt_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `reading_progress`
--
ALTER TABLE `reading_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `fk_reading_progress_user_id` (`user_id`);

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
-- Indexes for table `requestedbook`
--
ALTER TABLE `requestedbook`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_requestedbook_user_id` (`user_id`);

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
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_tokens_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reading_progress`
--
ALTER TABLE `reading_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rental_transactions`
--
ALTER TABLE `rental_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234;

--
-- AUTO_INCREMENT for table `rented_books_history`
--
ALTER TABLE `rented_books_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requestedbook`
--
ALTER TABLE `requestedbook`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD CONSTRAINT `admin_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reading_progress`
--
ALTER TABLE `reading_progress`
  ADD CONSTRAINT `fk_reading_progress_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reading_progress_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`isbn_no`);

--
-- Constraints for table `rental_transactions`
--
ALTER TABLE `rental_transactions`
  ADD CONSTRAINT `fk_rental_transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rental_transactions_ibfk_2` FOREIGN KEY (`isbn_no`) REFERENCES `books` (`isbn_no`);

--
-- Constraints for table `rented_books_history`
--
ALTER TABLE `rented_books_history`
  ADD CONSTRAINT `fk_rented_books_history_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rented_books_history_ibfk_2` FOREIGN KEY (`isbn_no`) REFERENCES `books` (`isbn_no`);

--
-- Constraints for table `requestedbook`
--
ALTER TABLE `requestedbook`
  ADD CONSTRAINT `fk_requestedbook_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`isbn_no`) REFERENCES `books` (`isbn_no`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_user_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
