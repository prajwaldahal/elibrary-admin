-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 11:01 AM
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
CREATE DATABASE IF NOT EXISTS `db_elibrary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_elibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` int(11) NOT NULL,
  `notification_type` enum('info','rented','expired','reported') NOT NULL,
  `message` text NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `admin_notification`
--

TRUNCATE TABLE `admin_notification`;
--
-- Dumping data for table `admin_notification`
--

INSERT INTO `admin_notification` (`id`, `notification_type`, `message`, `user_id`, `created_at`, `updated_at`, `is_read`) VALUES
(123591, 'rented', 'A book with ISBN 9780132350884 has been rented by user ID 10007', '10007', '2024-09-23 08:36:56', '2024-09-23 08:58:05', 1),
(123592, 'rented', 'A book with ISBN 9780321573513 has been rented by user ID 10007', '10007', '2024-09-23 08:36:56', '2024-09-23 08:58:05', 1),
(123593, 'rented', 'A book with ISBN 9780321573513 has been rented by user ID 10009', '10009', '2024-09-23 08:36:56', '2024-09-23 08:58:05', 1),
(123594, 'rented', 'A book with ISBN 9780136142510 has been rented by user ID 10010', '10010', '2024-09-23 08:36:56', '2024-09-23 08:58:05', 1),
(123595, 'expired', 'Rental transaction for book ISBN 9780132350884 has expired for user ID10003', '10003', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123596, 'expired', 'Rental transaction for book ISBN 9780134494165 has expired for user ID10003', '10003', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123597, 'expired', 'Rental transaction for book ISBN 9780134177304 has expired for user ID10006', '10006', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123598, 'expired', 'Rental transaction for book ISBN 9780134177304 has expired for user ID10001', '10001', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123599, 'expired', 'Rental transaction for book ISBN 9781491946008 has expired for user ID10005', '10005', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123600, 'expired', 'Rental transaction for book ISBN 9780201616224 has expired for user ID10008', '10008', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123601, 'expired', 'Rental transaction for book ISBN 9780134494165 has expired for user ID10001', '10001', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123602, 'expired', 'Rental transaction for book ISBN 9780134494165 has expired for user ID10005', '10005', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123603, 'expired', 'Rental transaction for book ISBN 9780201616224 has expired for user ID10001', '10001', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123604, 'expired', 'Rental transaction for book ISBN 9780201616224 has expired for user ID10006', '10006', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123605, 'expired', 'Rental transaction for book ISBN 9780136142510 has expired for user ID10010', '10010', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123606, 'expired', 'Rental transaction for book ISBN 9781491946008 has expired for user ID10004', '10004', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123607, 'expired', 'Rental transaction for book ISBN 9780321573513 has expired for user ID10004', '10004', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123608, 'expired', 'Rental transaction for book ISBN 9781491946008 has expired for user ID10006', '10006', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123609, 'expired', 'Rental transaction for book ISBN 9780132350884 has expired for user ID10003', '10003', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123610, 'expired', 'Rental transaction for book ISBN 9781491946008 has expired for user ID10007', '10007', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123611, 'expired', 'Rental transaction for book ISBN 9780201616224 has expired for user ID10010', '10010', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123612, 'expired', 'Rental transaction for book ISBN 9780321573513 has expired for user ID10001', '10001', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123613, 'expired', 'Rental transaction for book ISBN 9780134685991 has expired for user ID10007', '10007', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123614, 'expired', 'Rental transaction for book ISBN 9780201616224 has expired for user ID10001', '10001', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123615, 'expired', 'Rental transaction for book ISBN 9780134177304 has expired for user ID10006', '10006', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123616, 'expired', 'Rental transaction for book ISBN 9780136142510 has expired for user ID10010', '10010', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123617, 'expired', 'Rental transaction for book ISBN 9780134177304 has expired for user ID10004', '10004', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123618, 'expired', 'Rental transaction for book ISBN 9780134494165 has expired for user ID10001', '10001', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123619, 'expired', 'Rental transaction for book ISBN 9780132350884 has expired for user ID10006', '10006', '2024-09-23 08:40:45', '2024-09-23 08:58:05', 1),
(123620, 'info', 'A new user10011 has been registerd ', '10011', '2024-09-23 08:45:34', '2024-09-23 08:58:05', 1),
(123621, 'expired', 'Rental transaction for book ISBN 9780132350884 has expired for user ID 10007', '10007', '2024-09-23 08:58:25', '2024-09-23 08:58:52', 1);

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
-- Truncate table before insert `books`
--

TRUNCATE TABLE `books`;
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
-- Truncate table before insert `categories`
--

TRUNCATE TABLE `categories`;
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
-- Truncate table before insert `reading_progress`
--

TRUNCATE TABLE `reading_progress`;
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
-- Truncate table before insert `rental_transactions`
--

TRUNCATE TABLE `rental_transactions`;
--
-- Dumping data for table `rental_transactions`
--

INSERT INTO `rental_transactions` (`id`, `user_id`, `isbn_no`, `rental_date`, `expiry_date`, `amount_paid`) VALUES
(61724, '10005', '9780134757590', '2024-02-29', '2025-05-15', '216.10'),
(61725, '10001', '9780321573513', '2022-02-28', '2025-04-15', '57.68'),
(61726, '10002', '9781491946008', '2023-10-20', '2025-10-31', '261.78'),
(61727, '10001', '9780321573513', '2022-11-12', '2025-08-09', '211.52'),
(61728, '10003', '9780134177304', '2024-04-15', '2024-12-18', '148.08'),
(61730, '10010', '9780134685991', '2024-04-29', '2025-07-14', '239.50'),
(61731, '10005', '9780134685991', '2023-09-24', '2025-02-22', '100.47'),
(61732, '10007', '9780134757590', '2023-03-22', '2025-02-14', '162.49'),
(61735, '10001', '9780136142510', '2023-09-29', '2025-06-17', '106.19'),
(61736, '10009', '9781491950357', '2024-08-06', '2025-11-23', '156.88'),
(61737, '10007', '9780321573513', '2022-12-20', '2025-10-03', '160.95'),
(61738, '10005', '9781491946008', '2022-10-12', '2025-01-26', '269.16'),
(61739, '10004', '9780136142510', '2023-05-30', '2025-07-05', '63.84'),
(61740, '10003', '9780132350884', '2024-03-12', '2025-09-28', '160.59'),
(61742, '10005', '9781491946008', '2022-04-28', '2025-09-02', '75.70'),
(61743, '10003', '9780201616224', '2023-08-25', '2025-07-14', '219.14'),
(61746, '10009', '9780134177304', '2023-02-08', '2025-06-20', '251.01'),
(61747, '10007', '9781491946008', '2023-05-06', '2025-09-07', '204.79'),
(61748, '10006', '9780134685991', '2023-02-08', '2025-01-19', '66.01'),
(61749, '10008', '9780136142510', '2024-03-12', '2025-07-20', '247.14'),
(61750, '10006', '9780134685991', '2022-08-12', '2025-02-11', '192.69'),
(61751, '10009', '9780132350884', '2023-12-30', '2025-11-23', '185.73'),
(61753, '10006', '9780136142510', '2023-04-09', '2025-11-08', '294.20'),
(61755, '10010', '9780201616224', '2024-07-21', '2025-03-09', '97.07'),
(61756, '10009', '9780134685991', '2022-04-11', '2025-02-19', '173.74'),
(61757, '10010', '9780132350884', '2024-02-20', '2025-06-19', '258.84'),
(61759, '10002', '9780136142510', '2022-03-02', '2025-06-03', '189.97'),
(61760, '10008', '9780134177304', '2023-05-04', '2025-01-21', '199.80'),
(61761, '10005', '9780201616224', '2023-02-22', '2025-06-30', '266.80'),
(61762, '10004', '9781491946008', '2023-08-20', '2024-12-12', '267.79'),
(61763, '10001', '9781491950357', '2024-04-30', '2025-04-24', '144.94'),
(61764, '10008', '9780132350884', '2023-07-17', '2025-07-26', '157.47'),
(61765, '10001', '9780321573513', '2024-05-15', '2025-02-19', '111.26'),
(61769, '10005', '9780132350884', '2024-02-18', '2025-05-01', '167.92'),
(61770, '10010', '9780134757590', '2024-01-30', '2025-06-02', '141.45'),
(61771, '10001', '9781491946008', '2022-12-17', '2024-12-28', '227.86'),
(61772, '10003', '9781491950357', '2022-02-12', '2024-12-22', '177.07'),
(61773, '10004', '9780134685991', '2024-05-25', '2025-10-31', '280.43'),
(61774, '10007', '9780134494165', '2023-01-18', '2025-10-10', '51.73'),
(61775, '10010', '9780201616224', '2022-05-02', '2025-04-21', '180.20'),
(61776, '10005', '9780321573513', '2024-07-29', '2025-08-01', '118.11'),
(61777, '10007', '9780134757590', '2023-03-18', '2025-05-18', '194.41'),
(61778, '10005', '9780134757590', '2022-08-02', '2024-12-29', '85.07'),
(61779, '10002', '9781491950357', '2022-03-15', '2025-02-18', '57.87'),
(61780, '10007', '9780134685991', '2024-08-21', '2025-11-14', '76.24'),
(61781, '10002', '9780321573513', '2023-07-08', '2025-11-14', '281.80'),
(61782, '10007', '9780134494165', '2022-09-10', '2025-12-10', '73.18'),
(61783, '10010', '9780134177304', '2022-10-14', '2024-12-29', '163.71'),
(61786, '10003', '9781491946008', '2022-10-26', '2025-05-02', '128.43'),
(61788, '10006', '9780132350884', '2024-07-14', '2025-12-20', '274.41'),
(61789, '10003', '9780201616224', '2023-04-19', '2025-10-14', '135.56'),
(61790, '10007', '9780134685991', '2023-10-14', '2025-05-04', '158.28'),
(61791, '10001', '9781491950357', '2023-02-13', '2025-10-21', '242.56'),
(61793, '10002', '9780134177304', '2023-12-02', '2025-04-02', '133.92'),
(61794, '10003', '9781491946008', '2023-10-30', '2025-10-10', '238.65'),
(61795, '10009', '9780134757590', '2024-01-27', '2025-02-21', '237.20'),
(61796, '10003', '9780321573513', '2022-06-27', '2025-11-13', '173.77'),
(61797, '10006', '9781491946008', '2024-05-19', '2025-09-20', '263.60'),
(61798, '10007', '9780134757590', '2023-01-06', '2025-07-12', '92.43'),
(61799, '10008', '9780132350884', '2023-06-16', '2025-05-30', '174.51'),
(61800, '10010', '9780134494165', '2023-06-26', '2025-12-15', '231.98'),
(61802, '10010', '9781491950357', '2023-04-25', '2025-07-01', '80.73'),
(61804, '10003', '9780134757590', '2024-02-22', '2025-05-11', '227.84'),
(61805, '10005', '9780134685991', '2024-06-10', '2024-12-17', '285.21'),
(61806, '10002', '9780201616224', '2023-05-10', '2024-12-27', '223.50'),
(61808, '10002', '9780201616224', '2023-07-13', '2025-08-10', '111.85'),
(61809, '10002', '9780132350884', '2024-04-01', '2025-09-21', '225.93'),
(61810, '10003', '9780134757590', '2023-09-04', '2025-04-26', '99.79'),
(61811, '10001', '9781491950357', '2024-06-19', '2025-04-20', '169.03'),
(61812, '10001', '9780201616224', '2023-12-04', '2025-03-26', '97.80'),
(61813, '10002', '9780132350884', '2023-05-31', '2025-07-24', '193.45'),
(61814, '10006', '9780134685991', '2023-10-25', '2025-12-06', '241.82'),
(61815, '10008', '9780132350884', '2023-10-19', '2025-05-09', '132.31'),
(61816, '10006', '9780321573513', '2022-01-13', '2025-03-27', '254.94'),
(61817, '10006', '9780134685991', '2023-08-02', '2025-07-31', '72.60'),
(61818, '10007', '9780134757590', '2023-02-26', '2025-10-08', '137.05'),
(61819, '10001', '9780134757590', '2022-06-12', '2025-12-24', '293.63'),
(61820, '10003', '9780201616224', '2022-10-12', '2024-11-29', '68.74'),
(61821, '10007', '9781491946008', '2024-08-11', '2025-01-14', '57.57'),
(61822, '10008', '9780132350884', '2022-09-13', '2024-12-18', '100.95'),
(61823, '10005', '9780134177304', '2024-08-15', '2025-12-02', '173.23'),
(61824, '10004', '9781491950357', '2022-09-28', '2025-05-14', '255.56'),
(61825, '10007', '9780134494165', '2022-12-28', '2025-12-23', '250.34'),
(61826, '10005', '9780321573513', '2024-08-02', '2025-05-15', '224.57'),
(61827, '10005', '9781491950357', '2024-06-15', '2025-03-15', '268.58'),
(61828, '10009', '9781491950357', '2023-09-24', '2025-08-02', '233.17'),
(61829, '10007', '9780134177304', '2023-01-09', '2024-11-27', '220.60'),
(61830, '10008', '9780132350884', '2023-09-06', '2025-09-23', '115.45'),
(61831, '10010', '9780136142510', '2024-07-14', '2025-05-27', '110.64'),
(61832, '10010', '9780134494165', '2022-05-02', '2025-12-26', '84.94'),
(61833, '10005', '9780134177304', '2024-07-31', '2025-12-15', '222.49'),
(61834, '10008', '9780134494165', '2022-06-09', '2024-11-30', '267.55'),
(61835, '10005', '9780134494165', '2023-02-16', '2025-01-17', '95.39'),
(61836, '10008', '9781491950357', '2023-04-24', '2025-10-01', '208.24'),
(61838, '10004', '9780132350884', '2023-07-27', '2025-07-01', '85.35'),
(61839, '10010', '9781491946008', '2022-05-28', '2025-11-25', '183.44'),
(61840, '10004', '9780132350884', '2024-07-09', '2025-05-12', '87.06'),
(61841, '10004', '9781491950357', '2022-03-29', '2025-09-06', '140.89'),
(61842, '10010', '9780134685991', '2023-11-02', '2025-07-15', '247.17'),
(61843, '10009', '9780321573513', '2024-04-19', '2025-03-10', '211.07'),
(61844, '10006', '9780134177304', '2023-04-02', '2025-09-08', '69.39'),
(61845, '10005', '9781491946008', '2022-10-19', '2025-10-11', '281.09'),
(61846, '10008', '9780134494165', '2023-04-19', '2025-03-22', '243.00'),
(61847, '10006', '9780132350884', '2022-07-11', '2025-09-09', '209.37'),
(61849, '10005', '9780134685991', '2023-07-18', '2025-10-08', '216.62'),
(61851, '10005', '9780132350884', '2023-10-07', '2025-12-23', '72.90'),
(61852, '10006', '9781491950357', '2024-07-02', '2025-05-12', '280.01'),
(61853, '10007', '9780134494165', '2023-08-24', '2025-12-29', '77.50'),
(61855, '10005', '9781491950357', '2022-12-06', '2024-12-13', '194.24'),
(61856, '10004', '9780134757590', '2022-08-27', '2025-03-05', '76.17'),
(61857, '10004', '9780136142510', '2022-11-25', '2025-04-28', '269.79'),
(61858, '10002', '9780134757590', '2023-12-27', '2025-09-04', '218.23'),
(61861, '10006', '9780132350884', '2023-07-30', '2025-08-20', '146.84'),
(61862, '10010', '9780134757590', '2023-02-23', '2025-01-24', '93.26'),
(61863, '10009', '9780134494165', '2022-10-30', '2025-06-15', '276.35'),
(61864, '10006', '9781491950357', '2022-09-14', '2025-11-27', '284.15'),
(61865, '10010', '9780134494165', '2022-06-09', '2025-12-11', '67.64'),
(61866, '10009', '9780134177304', '2024-05-27', '2025-03-15', '111.03'),
(61867, '10006', '9781491950357', '2023-05-31', '2025-01-25', '114.72'),
(61868, '10008', '9780134177304', '2024-01-22', '2025-11-28', '105.40'),
(61869, '10007', '9780132350884', '2024-02-07', '2025-08-19', '174.01'),
(61870, '10007', '9780321573513', '2023-08-04', '2025-10-07', '220.94'),
(61871, '10009', '9780321573513', '2022-03-13', '2025-10-30', '129.28'),
(61872, '10010', '9780136142510', '2024-03-26', '2025-10-31', '246.83');

--
-- Triggers `rental_transactions`
--
DELIMITER $$
CREATE TRIGGER `after_insert_rental_transaction` AFTER INSERT ON `rental_transactions` FOR EACH ROW BEGIN
    DECLARE notification_message TEXT;
    
    SET notification_message = CONCAT('A book with ISBN ', NEW.isbn_no, ' has been rented by user ID ', NEW.user_id);
    
    INSERT INTO admin_notification (notification_type, message, user_id)
    VALUES ('rented', notification_message, NEW.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_rental_transaction` BEFORE DELETE ON `rental_transactions` FOR EACH ROW BEGIN
    DECLARE notification_message TEXT;
    
    INSERT INTO rented_books_history (user_id, isbn_no, rented_date, expired_date, price)
    VALUES (OLD.user_id, OLD.isbn_no, OLD.rental_date, OLD.expiry_date, OLD.amount_paid);
    
    SET notification_message = CONCAT('Rental transaction for book ISBN ', OLD.isbn_no, ' has expired for user ID ',OLD.user_id);

    INSERT INTO admin_notification (notification_type, message, user_id)
    VALUES ('expired', notification_message, OLD.user_id);
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

--
-- Truncate table before insert `rented_books_history`
--

TRUNCATE TABLE `rented_books_history`;
--
-- Dumping data for table `rented_books_history`
--

INSERT INTO `rented_books_history` (`id`, `user_id`, `isbn_no`, `rented_date`, `expired_date`, `price`) VALUES
(61863, '10003', '9780132350884', '2024-02-29', '2024-10-05', '91.89'),
(61864, '10003', '9780134494165', '2023-08-20', '2024-10-06', '165.38'),
(61865, '10006', '9780134177304', '2022-08-22', '2024-10-06', '219.54'),
(61866, '10001', '9780134177304', '2022-01-31', '2024-10-07', '226.71'),
(61867, '10005', '9781491946008', '2023-10-03', '2024-10-10', '239.37'),
(61868, '10008', '9780201616224', '2024-05-24', '2024-10-16', '208.26'),
(61869, '10001', '9780134494165', '2023-08-12', '2024-10-17', '239.59'),
(61870, '10005', '9780134494165', '2022-12-22', '2024-10-17', '109.20'),
(61871, '10001', '9780201616224', '2024-09-06', '2024-10-19', '180.50'),
(61872, '10006', '9780201616224', '2023-06-16', '2024-10-21', '248.11'),
(61873, '10010', '9780136142510', '2024-06-09', '2024-10-22', '188.75'),
(61874, '10004', '9781491946008', '2022-06-29', '2024-10-23', '163.80'),
(61875, '10004', '9780321573513', '2023-12-30', '2024-10-24', '242.83'),
(61876, '10006', '9781491946008', '2024-06-27', '2024-10-27', '91.62'),
(61877, '10003', '9780132350884', '2023-10-08', '2024-10-28', '121.41'),
(61878, '10007', '9781491946008', '2023-06-26', '2024-11-02', '267.77'),
(61879, '10010', '9780201616224', '2022-01-12', '2024-11-02', '163.26'),
(61880, '10001', '9780321573513', '2023-06-12', '2024-11-12', '152.01'),
(61881, '10007', '9780134685991', '2023-11-12', '2024-11-12', '55.49'),
(61882, '10001', '9780201616224', '2022-07-18', '2024-11-15', '137.84'),
(61883, '10006', '9780134177304', '2023-07-21', '2024-11-16', '154.67'),
(61884, '10010', '9780136142510', '2023-09-27', '2024-11-18', '294.20'),
(61885, '10004', '9780134177304', '2022-07-30', '2024-11-21', '210.94'),
(61886, '10001', '9780134494165', '2022-10-24', '2024-11-26', '186.18'),
(61887, '10006', '9780132350884', '2022-11-11', '2024-11-27', '236.95'),
(61888, '10007', '9780132350884', '2022-11-16', '2025-06-20', '220.63');

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
-- Truncate table before insert `requestedbook`
--

TRUNCATE TABLE `requestedbook`;
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
-- Truncate table before insert `reviews`
--

TRUNCATE TABLE `reviews`;
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
  `full_name` varchar(100) DEFAULT NULL,
  `registration_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `full_name`, `registration_date`, `last_login`) VALUES
('10001', 'user1@example.com', 'User One', '2024-01-01', NULL),
('10002', 'user2@example.com', 'User Two', '2024-01-02', NULL),
('10003', 'user3@example.com', 'User Three', '2024-01-03', NULL),
('10004', 'user4@example.com', 'User Four', '2024-01-04', NULL),
('10005', 'user5@example.com', 'User Five', '2024-01-05', NULL),
('10006', 'user6@example.com', 'User Six', '2024-01-06', NULL),
('10007', 'user7@example.com', 'User Seven', '2024-01-07', NULL),
('10008', 'user8@example.com', 'User Eight', '2024-01-08', NULL),
('10009', 'user9@example.com', 'User Nine', '2024-01-09', NULL),
('10010', 'user10@example.com', 'User Ten', '2024-01-10', NULL),
('10011', 'user10011@gmail.com', 'wqerghjmm', '2024-09-10', '2024-09-24 14:30:04');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_added` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE notification_message TEXT;
    
    SET notification_message = CONCAT('A new user ',NEW.id, ' has been registerd ');
    
    INSERT INTO admin_notification (notification_type, message, user_id)
    VALUES ('info', notification_message, NEW.id);
END
$$
DELIMITER ;

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
-- Truncate table before insert `user_tokens`
--

TRUNCATE TABLE `user_tokens`;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123622;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61873;

--
-- AUTO_INCREMENT for table `rented_books_history`
--
ALTER TABLE `rented_books_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61889;

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
