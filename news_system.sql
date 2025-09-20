-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2025 at 04:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Politics'),
(4, 'Sports'),
(5, 'Technology'),
(6, 'Health'),
(7, 'Beauty'),
(8, 'Entertainment'),
(9, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category_id`, `details`, `image`, `user_id`, `deleted`, `created_at`) VALUES
(3, 'Gaza City under relentless bombardment as Israel launches ground invasion', 1, 'The UN chief calls situation in Gaza ‘horrendous’ as a UN inquiry concludes that Israel’s nearly two-year war on Gaza amounts to genocide.', '1758045041_1758044792_gaza1.webp', 2, 0, '2025-09-16 20:50:41'),
(4, 'Qatar hosts Arab-Islamic emergency summit: Who said what?', 1, 'Arab and Muslim leaders gather in Qatar to condemn Israel’s attack in Doha, and warn that war on Gaza is a campaign of extermination.', '1758045786_arabs.webp', 2, 0, '2025-09-16 21:03:06'),
(5, 'UEFA Champions League 2025-26: Full match schedule and clubs', 4, 'The 2025-26 UEFA Champions League kicks off on Tuesday, with the league phase of the tournament getting under way.\r\n\r\nEurope’s largest club competition is entering its 70th year, with Paris Saint-Germain (PSG) the defending champions.', '1758046343_sport.webp', 3, 0, '2025-09-16 21:12:23'),
(6, 'Malaysia: Where there is something for everyone', 9, 'A truly multicultural and multilayered country, Malaysia has something to offer everyone. From glorious beaches and rainforests to educational opportunities and cultural experiences like no other, there’s a lot to discover here.', '1758046639_travel.jpg', 3, 0, '2025-09-16 21:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Reema', 'r@gmail.com', '$2y$10$iNymbfdjnJUkghAKMvaguuMdqIlhO5M6jYSb3G9fpeJfl500enone'),
(2, 'Alia', 'a@gmail.com', '$2y$10$fgcrTdcTEhbUTK6Yelc7nOpvr0onRgz7hncrACpBac8XWn01IOjwq'),
(3, 'as', 'as@gmail.com', '$2y$10$cfEqiyeMIlHOB9Q7A.SrWutlqpS4qu4tpjPpWQ4WY/5tqhUSlKste'),
(4, 'Zeana', 'z@gmail.com', '$2y$10$kaeLXtOgE.xnhOm9j8fererREPN4zKBUczpEhkIXduzh/JFrKBlyO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
