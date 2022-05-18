-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 12:55 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slsudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(75) NOT NULL,
  `status` varchar(50) NOT NULL,
  `usertype` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Id`, `name`, `username`, `password`, `status`, `usertype`) VALUES
(1, 'Admin', 'admin@gmail.com', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'Active', '1'),
(4, 'Geraldine Mangmang', 'geraldine@gmail.com', 'ae56b5dc7624c923a19088cba2b19b44a254c236', 'Active', '2'),
(37, 'Romeo Reyes', 'romeo@gmail.com', 'eac85f773d67138f28177b8330730e3e4363c875', 'Active', '2'),
(42, 'Rico Nemenzo', 'rico@gmail.com', '2affaef592569667bbc4c70dae8e877a3d0943bf', 'Active', '3'),
(44, 'Richard Gomez', 'richard@gmail.com', '320bca71fc381a4a025636043ca86e734e31cf8b', 'Active', '4'),
(45, 'Juvie Reyes', 'juvie@gmail.com', 'dc107fd4d7a7cb25c3d39bcdbcf1b1f94086eccb', 'Active', '4'),
(48, 'Mario', 'mario@gmail.com', 'addb47291ee169f330801ce73520b96f2eaf20ea', 'Active', '2'),
(49, 'Maricar Reyes', 'maricar@gmail.com', '0e75d1d7952a0461c3d4f78487e0245f6e62a5cd', 'Active', '3'),
(61, 'Kevin Jay Napoles Roluna', 'kevinjayroluna@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'Active', '4');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `age` int(50) NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `profile` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `address`, `age`, `job_position`, `profile`) VALUES
(1, 'Sogod, Southern Leyte', 23, 'Administrator', 'IMG20210724131325.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `Id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `company` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`Id`, `title`, `description`, `company`, `date_created`, `user_id`) VALUES
(3, 'Sample1', 'The Southern Leyte State University (SLSU) Graduate School has been chosen by the Commission on Higher Education (CHED) as a Delivering Higher Education Institution (DHEI) of the Scholarships for Instructors’ Knowledge Advanc', 'All', 'October 19, 2021', 4),
(7, 'Sample', 'asdasdad', 'Dole-R07', 'October 20, 2021', 4),
(10, 'OJT Scholar', 'The Southern Leyte State University (SLSU) Graduate School has been chosen by the Commission on Higher Education (CHED) as a Delivering Higher Education Institution (DHEI) of the Scholarships for Instructors’ Knowledge Advanc', 'All', 'November 3, 2021', 4),
(11, 'Semistral Break', 'The Southern Leyte State University (SLSU) Graduate School has been chosen by the Commission on Higher Education (CHED) as a Delivering Higher Education Institution (DHEI) of the Scholarships for Instructors’ Knowledge Advanc', 'All', 'November 3, 2021', 4),
(12, 'Sample 2', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will.', 'Dole-R07', 'November 3, 2021', 9),
(13, 'Sample III', 'The Higher Education (CHED) as a Delivering Higher Education Institution (DHEI) of the Scholarships for Instructors’ Knowledge Advanc', 'All', 'November 13, 2021', 4);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(12) NOT NULL,
  `company` text NOT NULL,
  `chat_name` text NOT NULL,
  `message` text NOT NULL,
  `chat_date_time` text NOT NULL DEFAULT current_timestamp(),
  `chat_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `company`, `chat_name`, `message`, `chat_date_time`, `chat_type`) VALUES
(1, 'Sample Only Testing', 'Kevin Jay Napoles Roluna', 'hi', '2022-05-18 11:34:51', 2),
(2, 'Sample Only Testing', 'Geraldine Mangmang', 'hello', '2022-05-18 11:35:18', 1),
(3, 'Sample Only Testing', 'Kevin Jay Napoles Roluna', 'pwede magtanong?', '2022-05-18 11:35:34', 2),
(4, 'Sample Only Testing', 'Geraldine Mangmang', 'ano tanong mo?', '2022-05-18 11:35:46', 1),
(5, 'Sample Only Testing', 'Geraldine Mangmang', 'hehe', '2022-05-18 11:36:20', 1),
(6, 'Sample Only Testing', 'Kevin Jay Napoles Roluna', 'papagawa niyo paba journal?', '2022-05-18 11:37:37', 2),
(7, 'Sample Only Testing', 'Geraldine Mangmang', 'hindi na sir hahah', '2022-05-18 11:37:47', 1),
(8, 'Sample Only Testing', 'Kevin Jay Napoles Roluna', 'asdasd', '2022-05-18 11:39:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `Id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `am_in` varchar(10) NOT NULL,
  `am_out` varchar(10) NOT NULL,
  `pm_in` varchar(10) NOT NULL,
  `pm_out` varchar(10) NOT NULL,
  `month` varchar(20) NOT NULL,
  `total_hrs_today` varchar(10) NOT NULL,
  `remaining_hrs` varchar(10) NOT NULL,
  `target_hours` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`Id`, `user_id`, `date`, `am_in`, `am_out`, `pm_in`, `pm_out`, `month`, `total_hrs_today`, `remaining_hrs`, `target_hours`) VALUES
(34, 44, 'November 3, 2021', '11:35:00', '11:46:10', '11:50:04', '11:58:30', 'November', '00:08:26', '', ''),
(35, 50, 'May 16, 2022', '07:34:43', '', '', '', 'May', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(12) NOT NULL,
  `student_id` int(12) NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `student_id`, `image`, `content`, `date_added`) VALUES
(6, 61, '1d96852cd57a128e.jpg', 'asdasd', '2022-05-18 08:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `Id` int(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `age` int(10) NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `profile` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`Id`, `department`, `user_id`, `address`, `age`, `job_position`, `profile`) VALUES
(4, 'CCSIT', 4, 'Sogod', 35, 'Software Engineer', 'Screenshot_2021-11-12-13-35-32-17.jpg'),
(26, 'CCJ', 37, '', 0, '', ''),
(27, 'CCSIT', 48, '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Id` int(50) NOT NULL,
  `student_id` varchar(75) NOT NULL,
  `department` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `assigned_company` varchar(75) NOT NULL,
  `location` varchar(75) NOT NULL,
  `user_id` int(50) NOT NULL,
  `img1` varchar(225) NOT NULL,
  `img2` varchar(225) NOT NULL,
  `img3` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Id`, `student_id`, `department`, `section`, `assigned_company`, `location`, `user_id`, `img1`, `img2`, `img3`) VALUES
(1, '1610131-1', 'CCSIT', 'A', 'Dole-R07', 'Lahug,Cebu City', 44, '', '', ''),
(2, '1910560-2', 'CCSIT', 'A', 'Unassigned', '', 45, '', '', ''),
(13, '09333', 'CHTM', 'A', 'Sample Only Testing', 'Caviter', 61, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `Id` int(50) NOT NULL,
  `company` varchar(75) NOT NULL,
  `location` varchar(75) NOT NULL,
  `department` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `age` int(50) NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `profile` varchar(75) NOT NULL,
  `personnel` int(50) NOT NULL,
  `year` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`Id`, `company`, `location`, `department`, `user_id`, `address`, `age`, `job_position`, `profile`, `personnel`, `year`) VALUES
(11, 'Dole-R07', 'Lahug,Cebu City', 'CCSIT', 42, 'Cebu City', 40, 'Inspector', '', 4, 2021),
(13, 'SmartStart', 'Las Vegas, USA', 'CCSIT', 49, '', 0, '', '', 4, 2021),
(14, 'Sample Only Testing', 'Caviter', 'CCSIT', 60, '', 0, '', '', 4, 2022);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
