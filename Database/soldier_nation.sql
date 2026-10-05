-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2026 at 07:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soldier_nation`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `member_id`, `attendance_date`) VALUES
(3, 14, '2026-10-02'),
(4, 15, '2026-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `coach_bookings`
--

CREATE TABLE `coach_bookings` (
  `booking_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach_bookings`
--

INSERT INTO `coach_bookings` (`booking_id`, `member_id`, `booking_date`, `start_time`, `end_time`, `status`) VALUES
(3, 14, '2026-10-02', '15:00:00', '16:00:00', 'Booked'),
(4, 15, '2026-10-05', '15:00:00', '16:00:00', 'Booked'),
(5, 15, '2026-10-06', '16:00:00', '17:00:00', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `coach_schedule`
--

CREATE TABLE `coach_schedule` (
  `schedule_id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach_schedule`
--

INSERT INTO `coach_schedule` (`schedule_id`, `day`, `start_time`, `end_time`) VALUES
(7, 'Monday', '15:00:00', '18:00:00'),
(8, 'Tuesday', '15:00:00', '18:00:00'),
(9, 'Wednesday', '15:00:00', '18:00:00'),
(10, 'Thursday', '15:00:00', '18:00:00'),
(11, 'Friday', '15:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `name`, `phone`, `registration_date`) VALUES
(14, 'Test member', '51234567', '2026-10-02'),
(15, 'Test member 3', '51831920', '2026-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `membership_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `member_id`, `amount`, `payment_type`, `payment_date`) VALUES
(7, 12, 200.00, 'Monthly Membership', '2026-10-02'),
(8, 12, 100.00, 'Entry Fee', '2026-10-02'),
(9, 14, 100.00, 'Monthly Membership', '2026-10-02'),
(10, 14, 199.99, 'Entry Fee', '2026-10-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `coach_bookings`
--
ALTER TABLE `coach_bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `coach_schedule`
--
ALTER TABLE `coach_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coach_bookings`
--
ALTER TABLE `coach_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coach_schedule`
--
ALTER TABLE `coach_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
