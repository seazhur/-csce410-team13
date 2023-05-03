-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2023 at 09:05 PM
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
-- Database: `trip2gether`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_users`
-- (See below for the actual view)
--
CREATE TABLE `admin_users` (
`username` varchar(255)
,`first_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `trip_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`trip_id`, `destination_id`) VALUES
(1, 5),
(2, 3),
(2, 7),
(3, 4),
(3, 2),
(4, 8),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `user_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`user_id`, `trip_id`) VALUES
(2, 1),
(4, 1),
(8, 2),
(6, 2),
(4, 2),
(2, 4),
(8, 3),
(6, 3),
(4, 4),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `rating`, `description`, `creation_time`, `user_id`, `destination_id`) VALUES
(1, 4, 'The state fair is a lot of fun-expensive, but fun. However Fair Park has a lot to offer after the fair is over.', '2023-04-06 06:03:00', 2, 1),
(2, 2, 'In my honest opinion entry to the Kennedy Space Center is seriously overpriced. 75 USD per person is far too expensive for what you actually get to do inside.', '2023-04-06 06:05:20', 4, 9),
(3, 0, 'You can\'t park on the Strip! You have to park at one of the major Casino\'s and do your walking from there.Parking fee\'s vary.', '2023-04-06 06:06:44', 8, 5),
(4, 5, 'The resort is massive and spread out like nobody’s business. It can take you a good 10 minutes just to walk to the lobby for some houses. While the grounds are nice and there are several pools, the resort is older and in need of a remodel.', '2023-04-06 06:09:19', 6, 4),
(5, 4, 'Disney world is one of my fav amusement parks, we’ve been here quite a few times. Amazing resorts and rides, especially for the little ones.', '2023-04-06 06:11:41', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(11) NOT NULL,
  `attraction` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `attraction`, `city`, `state`) VALUES
(1, 'State Fair of Texas', 'Dallas', 'Texas'),
(2, 'Universal Studios', 'Orlando', 'Florida'),
(3, 'Statue of Liberty', 'New York', 'New York'),
(4, 'Walt Disney World Resort', 'Orlando', 'Florida'),
(5, 'Las Vegas Strip', 'Las Vegas', 'Nevada'),
(6, 'Golden Gate Bridge', 'San Francisco', 'California'),
(7, 'Times Square', 'New York', 'New York'),
(8, 'River Walk', 'San Antonio', 'Texas'),
(9, 'Kennedy Space Center', 'Merritt Island', 'Florida'),
(10, 'Mount Rushmore National Memorial', 'Keystone', 'South Dakota');

-- --------------------------------------------------------

--
-- Stand-in structure for view `florida_attractions`
-- (See below for the actual view)
--
CREATE TABLE `florida_attractions` (
`attraction` varchar(255)
,`state` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nicest_comments`
-- (See below for the actual view)
--
CREATE TABLE `nicest_comments` (
`rating` int(11)
,`description` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `start_date`, `end_date`) VALUES
(2, '2023-04-16', '2023-04-29'),
(1, '2023-05-01', '2023-05-05'),
(3, '2023-08-01', '2023-08-31'),
(4, '2023-12-14', '2023-12-16');

-- --------------------------------------------------------

--
-- Stand-in structure for view `upcoming_trips`
-- (See below for the actual view)
--
CREATE TABLE `upcoming_trips` (
`start_date` date
,`end_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `auth_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `age`, `auth_user`) VALUES
(2, 'seazhur', 'password_c', 'Cesar', 'Fuentes', '2147890012', 24, 1),
(4, 'jessikuh', 'password_j', 'Jessyka', 'Flores', '0000000000', 22, 1),
(6, 'jennee', 'password_j', 'Jenny', 'Nguyen', '0000000000', 22, 1),
(8, 'adeeduv', 'password_a', 'Adidev', 'Mohapatra', '0000000000', 22, 1),
(10, 'username', 'password', 'Julio', 'Ramirez', '0000000000', 10, 0);

-- --------------------------------------------------------

--
-- Structure for view `admin_users`
--
DROP TABLE IF EXISTS `admin_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admin_users`  AS SELECT `users`.`username` AS `username`, `users`.`first_name` AS `first_name` FROM `users` WHERE `users`.`auth_user` = 11  ;

-- --------------------------------------------------------

--
-- Structure for view `florida_attractions`
--
DROP TABLE IF EXISTS `florida_attractions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `florida_attractions`  AS SELECT `destinations`.`attraction` AS `attraction`, `destinations`.`state` AS `state` FROM `destinations` WHERE `destinations`.`state` = 'Florida''Florida'  ;

-- --------------------------------------------------------

--
-- Structure for view `nicest_comments`
--
DROP TABLE IF EXISTS `nicest_comments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nicest_comments`  AS SELECT `comments`.`rating` AS `rating`, `comments`.`description` AS `description` FROM `comments` WHERE `comments`.`rating` = 55  ;

-- --------------------------------------------------------

--
-- Structure for view `upcoming_trips`
--
DROP TABLE IF EXISTS `upcoming_trips`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `upcoming_trips`  AS SELECT `trips`.`start_date` AS `start_date`, `trips`.`end_date` AS `end_date` FROM `trips` WHERE `trips`.`start_date` > curdate()  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `destination_id` (`destination_id`),
  ADD KEY `user_id_2` (`user_id`,`destination_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `attraction` (`attraction`,`city`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `start_date` (`start_date`,`end_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `last_name` (`last_name`,`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`trip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
