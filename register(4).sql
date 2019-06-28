-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2019 at 04:59 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `dp_user`
--

CREATE TABLE `dp_user` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_user`
--

INSERT INTO `dp_user` (`id`, `path`, `user`) VALUES
(2, 'uploads/1560314330goku.jpeg', '1'),
(14, 'uploads/1560341207chi.jpeg', '6'),
(31, 'uploads/1560418858moit.jpg', '7');

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

CREATE TABLE `registered_user` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `email` text,
  `password` text,
  `image` text,
  `name` text,
  `fav` text,
  `bday` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`id`, `parent`, `email`, `password`, `image`, `name`, `fav`, `bday`) VALUES
(1, 0, '...?1jjkadm@@@8010()(*sayan@gmail.com', '3bc1a2ffcd48420c8f5479012b9ba78b', 'uploads/1560490555goku.jpeg', 'Sayan Chakraborty', 'PHP', '29/10/1994');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dp_user`
--
ALTER TABLE `dp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`(200));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dp_user`
--
ALTER TABLE `dp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `registered_user`
--
ALTER TABLE `registered_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
