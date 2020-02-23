-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2020 at 03:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `besmart`
--
CREATE DATABASE IF NOT EXISTS `besmart` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `besmart`;

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE `discipline` (
  `id_discipline` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`id_discipline`, `Name`) VALUES
(2, 'Математика'),
(3, 'Физика'),
(4, 'Химия');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_teachProfile` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_teachProfile`, `rating`, `date`) VALUES
(1, 1, 5, '2020-02-12'),
(2, 1, 4, '2020-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id_teacher` int(11) NOT NULL,
  `FIO` varchar(500) NOT NULL,
  `Avatar` varchar(500) NOT NULL,
  `Avatar_mini` varchar(255) NOT NULL,
  `education` text NOT NULL,
  `about_me` text NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `experience` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id_teacher`, `FIO`, `Avatar`, `Avatar_mini`, `education`, `about_me`, `login`, `password`, `experience`, `phone`, `email`) VALUES
(1, 'Иванов Иван Иванович\r\n', 'ivanov1_big.jpg', 'ivanov1_small.jpg', 'Закончил Московский государственный университет по специальности прикладная математика', 'Обо мне', 'ivanov', '12345', 'Имею богатый опыт преподавания. Работал преподавателем в университете 10 лет. 2 года занимаюсь репетиторством.', '+79635401204', 'ivanov@mail.ru');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id_profile` int(11) NOT NULL,
  `id_discipline` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_favourite` tinyint(1) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`id_profile`, `id_discipline`, `id_teacher`, `active`, `is_favourite`, `price`) VALUES
(1, 2, 1, 1, 0, 350);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id_discipline`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_teachProfile` (`id_teachProfile`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id_teacher`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD KEY `id_discipline` (`id_discipline`),
  ADD KEY `id_teacher` (`id_teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id_discipline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id_teacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_teachProfile`) REFERENCES `teacher_profile` (`id_profile`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD CONSTRAINT `teacher_profile_ibfk_1` FOREIGN KEY (`id_discipline`) REFERENCES `discipline` (`id_discipline`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_profile_ibfk_2` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`id_teacher`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
