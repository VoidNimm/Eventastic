-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2025 at 02:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventastic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `EventImage` varchar(255) NOT NULL,
  `EventCategory` varchar(255) NOT NULL,
  `EventDescription` text DEFAULT NULL,
  `EventVariant` varchar(255) DEFAULT NULL,
  `EventPricePerVariant` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `EventName`, `EventImage`, `EventCategory`, `EventDescription`, `EventVariant`, `EventPricePerVariant`) VALUES
(4, 'Wedding Natan', 'img/andrea-mininni-VLlkOJdzLG0-unsplash.jpg', 'wedding', 'Wedding Natan sangat seru ada party asik-asik', 'Wedding', 1200000.00),
(6, 'Bussines Meeting', 'img/al-nik-J5XqX-qvEZE-unsplash.jpg', 'business', 'asdasdsrdsdvhjkglggiguiopo', 'Bussines', 2000000.00),
(7, 'Birthday Party Affat', 'img/chuttersnap-Q_KdjKxntH8-unsplash.jpg', 'concert', 'anjaz anjaz anjaz anjaz anjaz anjaz anjaz', 'Birthday', 1000000.00),
(8, 'Party Outside', 'img/kate-trysh-ZUWls_bDgAk-unsplash.jpg', 'concert', 'Party asix sangat seru wajib beli, semoga kalian sehat selalu', 'Party', 1500000.00),
(9, 'Meeting Eventastic', 'img/chuttersnap-cX2vElQ5aHk-unsplash.jpg', 'business', 'Profesional meeting untuk perusahaan teknologi indonesia', 'Bussines', 3000000.00),
(10, 'Marapthon Long Run 500Km', 'img/martins-zemlickis-NPFu4GfFZ7E-unsplash.jpg', 'sports', 'Buat orang sehat-sehat, biar sehat-sehat, dan untuk masa depan yang sehat', 'Sport Run', 2500000.00),
(11, 'Meeting meeting an', 'img/stem-list-EVgsAbL51Rk-unsplash.jpg', 'business', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'Bussines', 1200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('pending','success','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `event_id`, `amount`, `payment_method`, `status`, `created_at`) VALUES
(6, 6, 4, 1000000.00, 'bank_transfer', 'success', '2025-03-09 10:00:29'),
(7, 6, 4, 1000000.00, 'bank_transfer', 'success', '2025-03-09 10:00:29'),
(10, 6, 4, 1000000.00, 'credit_card', 'success', '2025-03-09 10:35:39'),
(13, 6, 4, 1000000.00, 'bank_transfer', 'success', '2025-03-09 14:21:51'),
(14, 2, 4, 1000000.00, 'bank_transfer', 'success', '2025-03-10 11:59:40'),
(15, 6, 6, 2000000.00, 'credit_card', 'success', '2025-03-10 13:15:41'),
(16, 6, 9, 3000000.00, 'credit_card', 'success', '2025-03-10 13:17:04'),
(17, 6, 10, 2500000.00, 'paypal', 'success', '2025-03-15 08:49:17'),
(18, 6, 6, 2000000.00, 'credit_card', 'success', '2025-05-14 23:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin1', 'admin1@gmail.com', '$2y$10$sMmCTM/fYx6NdFqYdpVRpePNTQeaeK955m4g4sEecEHOo/jvFfg9q', 'admin', '2025-02-27 11:16:22'),
(2, 'user123', 'user100@gmail.com', '$2y$10$KXjUsLRs7rmaPExHDwmBC.P.HBWhU5ZvWTX3LnQFGOfxdJCNRHLmG', 'user', '2025-02-27 11:37:32'),
(3, 'tes', 'tes@gmail.com', '$2y$10$z27gAeDGgQ6XSH9FJwHWiuxakuu.56xqw2ReWRiL6zxeZ0PAJz6zC', 'user', '2025-02-27 12:23:33'),
(4, 'ppp', 'ppp@gmail.com', '$2y$10$m9aMaf4JJqNxmpIazBnHTuPqW1HOX/qHJf7FhEZAjHl8V7a8yyC/u', 'user', '2025-02-27 12:24:59'),
(5, 'jawa', 'jawa123@gmail.com', '$2y$10$JSiP/QImL8ZhtQHPPBfO8e2xFPB3NjN0aHvhLUraeLxrG6sgUZvwm', 'user', '2025-03-06 00:23:21'),
(6, 'ghanim', 'ghanim88@gmail.com', '$2y$10$QK3iTvozBijw9A9N/RtMduuT/u2JoKuIC1KU.14/0h1I8O0TJ.ouO', 'user', '2025-03-09 09:51:37'),
(7, 'admin2', 'admin2@example.com', '$2y$10$PUvUfXmLcOj20djTJLW85eqjSVESbnh6k0.IRFc5Et28EXzX92RDC', 'admin', '2025-03-10 12:10:40'),
(8, 'damar', 'damaritem@gmail.com', '$2y$10$1K/cA7F3SBQ3oW7/cqa75elPqj0ricoGEBhj/aoWPMkclJOLVhOLe', 'admin', '2025-03-15 08:47:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
