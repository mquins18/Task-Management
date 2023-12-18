-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 06:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deadline` datetime NOT NULL,
  `assigned_to` varchar(255) NOT NULL,
  `completed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `deadline`, `assigned_to`, `completed`) VALUES
(1, 4, 'qwe', 'qwe', '0000-00-00 00:00:00', '', 0),
(2, 4, 'eqwe', 'qwe', '0000-00-00 00:00:00', 'qwe', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'sher', 'sp.malapitan@mseuf.edu.ph', '0'),
(2, 'qwe', 'qwe@qwe', '0'),
(4, 'sp.malapitan@mseuf.edu.ph', 'sherwin.malapitan09@gmail.com', '$2y$10$zHh1416WJzGTV.aMEEiSa.o/b1xALMva6RuuFVR8Q18/5w0J.x3A2'),
(5, 'sherwin', 'shawi@com', '$2y$10$5xQg1qhszzKoTVpj1TXJOulz6XpYbeXbxQHINXBMJr1Ygo02L1nd6'),
(6, 'sherr', 'qwe@qwe1', '$2y$10$ZbB6SRh3/vXNyjVb5SbYQ.td4d2umJt5HT8mN5Jx4JbamrYP9Qu1O'),
(7, 'she', 'sher@1', '$2y$10$cNWcBxS42nzXYgICYp1IneKLKdjd2Z9OgyIitTCzErFzPkTadrPYW'),
(8, 'eqwe', 'qwe@1', '$2y$10$0OvmEsP1YaEaLuDmvT5MmuGG9lQd.TFHIy5mUeBepFzKATGL4NL7e'),
(10, 'eqwe', 'qwe@111', '$2y$10$gZ70iuN1mJn81JQhRlj3remcdT6DHzgJRpwvti9R0S2Sh5K/K8lmG'),
(12, 'admin', 'qwe@1111', '$2y$10$f6UOkTW6f70lftFjtj27NuGLSYpdRFeDP/lPtDbvPjFNumTNU0IeO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
