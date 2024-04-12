-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 10:47 PM
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
-- Database: `staff_mgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ClassID` int(11) NOT NULL,
  `Class` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassID`, `Class`) VALUES
(5, 'Class 5'),
(6, 'Class 6'),
(7, 'JHS1'),
(8, 'JHS2'),
(9, 'JHS3');

-- --------------------------------------------------------

--
-- Table structure for table `clocking`
--

CREATE TABLE `clocking` (
  `ClockingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ClockInTime` datetime DEFAULT NULL,
  `ClockOutTime` datetime DEFAULT NULL,
  `TotalWorkHours` decimal(10,2) DEFAULT NULL,
  `day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `clocking`
--
DELIMITER $$
CREATE TRIGGER `update_day_on_insert` BEFORE INSERT ON `clocking` FOR EACH ROW BEGIN
    SET NEW.day = CURDATE();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseName` varchar(100) DEFAULT NULL,
  `CourseDescription` varchar(255) DEFAULT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `UserID`, `CourseName`, `CourseDescription`, `ClassID`) VALUES
(1, NULL, 'French', 'The language of romance', 5),
(2, 3, 'Math', 'Core Subject', 6),
(3, 3, 'French', 'No-core subject', 5),
(4, 3, 'ghjk', 'hjkl', 5),
(5, 3, 'Social Studies', 'Core Subject', 7);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_location`, `created_at`, `updated_at`) VALUES
(2, 'Ghana Day', '2024-04-12', 'RB215', '2024-04-11 23:10:48', '2024-04-11 23:10:48'),
(3, 'Career Workshop', '2024-04-26', 'PN112', '2024-04-11 23:13:18', '2024-04-11 23:13:18'),
(4, 'Football Match', '2024-04-19', 'Field', '2024-04-11 23:20:34', '2024-04-11 23:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `managementevaluations`
--

CREATE TABLE `managementevaluations` (
  `evaluationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `EvaluationDate` date DEFAULT curdate(),
  `Effectiveness` int(11) DEFAULT NULL,
  `SLO` int(11) DEFAULT NULL,
  `Teamwork` int(11) DEFAULT NULL,
  `ProfessionalDevelopment` int(11) DEFAULT NULL,
  `PolicyAdherence` int(11) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `TotalSum` int(11) DEFAULT NULL,
  `teacherId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managementevaluations`
--

INSERT INTO `managementevaluations` (`evaluationID`, `UserID`, `EvaluationDate`, `Effectiveness`, `SLO`, `Teamwork`, `ProfessionalDevelopment`, `PolicyAdherence`, `Comments`, `TotalSum`, `teacherId`) VALUES
(1, 6, NULL, 6, 13, 3, 5, 7, 'Erm good work Angela', 34, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `RoleName`) VALUES
(3, 'management'),
(1, 'student'),
(2, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `studentevaluations`
--

CREATE TABLE `studentevaluations` (
  `EvaluationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseMaterials` int(11) DEFAULT NULL,
  `Engagement` int(11) DEFAULT NULL,
  `OverallSatisfaction` int(11) DEFAULT NULL,
  `TeachingEffectiveness` int(11) DEFAULT NULL,
  `Feedback` int(11) DEFAULT NULL,
  `Availability` int(11) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `TotalSum` int(11) GENERATED ALWAYS AS (`CourseMaterials` + `Engagement` + `OverallSatisfaction` + `TeachingEffectiveness` + `Feedback` + `Availability`) VIRTUAL,
  `teacherId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentevaluations`
--

INSERT INTO `studentevaluations` (`EvaluationID`, `UserID`, `CourseMaterials`, `Engagement`, `OverallSatisfaction`, `TeachingEffectiveness`, `Feedback`, `Availability`, `Comments`, `teacherId`) VALUES
(1, 3, 7, 8, 7, 12, 7, 7, 'Mrs. Angela is actually not bad at all!', NULL),
(12, 3, 8, 6, 7, 11, 7, 7, 'Mrs. Angela has helped me do better!', NULL),
(13, 3, 8, 6, 7, 11, 7, 7, 'Mrs. Angela has helped me do better!', NULL),
(14, 3, 8, 10, 8, 15, 7, 4, 'None', NULL),
(15, 3, 8, 10, 8, 15, 7, 4, 'None', NULL),
(16, 3, 8, 10, 8, 15, 7, 4, 'None', NULL),
(17, 3, 8, 10, 8, 15, 7, 4, 'None', NULL),
(18, 3, 8, 10, 8, 15, 7, 4, 'None', NULL),
(19, 3, 8, 10, 8, 15, 7, 4, 'None', NULL),
(20, 7, 5, 5, 5, 8, 4, 5, 'dfghjkl', NULL),
(21, 7, 6, 5, 5, 10, 3, 4, '0', 4);

-- --------------------------------------------------------

--
-- Table structure for table `teacherperformance`
--

CREATE TABLE `teacherperformance` (
  `PerformanceID` int(11) NOT NULL,
  `teachername` varchar(255) DEFAULT NULL,
  `teacherscore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacherperformance`
--

INSERT INTO `teacherperformance` (`PerformanceID`, `teachername`, `teacherscore`) VALUES
(1, 'Angela Benning', 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Role`, `Password`) VALUES
(3, 'Angela', 'B', 'Cool123@gmail.com', '0248261389', 'student', '$2y$10$jqJ5IzGmhZxlkZZGnkrVwuqBgaRX8UYj4wF1KAjzqMtGnq4RRS0ze'),
(4, 'Angela', 'Benning', 'benningangela14@gmail.com', '0248261389', 'teacher', '$2y$10$5tDqfti4qHsGFCBeYKXRiOWbsd0ZMS8vdGaxGK4X4y8Vmvpimrs0a'),
(5, 'Boo', 'Hoo', 'BooHoo@gmail.com', '0248261389', 'student', '$2y$10$AqoIdPOYsuA5HShDeCANAe8OLnyYtpO4km/opRLi8T3qqARyS5V2G'),
(6, 'Rachel', 'Book', 'rachbook12@gmail.com', '0248261389', 'management', '$2y$10$NNjofYEueH7BzO9wByaJkeGf3rYW264ln6LFlxw69PYXNudDLLBcm'),
(7, 'Angela', 'B', 'fro12@gmail.com', '0248261389', 'student', '$2y$10$NCz3Hfu49Y9PqpANYI0uuOi.1bUD0Eh.XTIrDJmfqC1ux2V95Q6Xq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `clocking`
--
ALTER TABLE `clocking`
  ADD PRIMARY KEY (`ClockingID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managementevaluations`
--
ALTER TABLE `managementevaluations`
  ADD PRIMARY KEY (`evaluationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `studentevaluations`
--
ALTER TABLE `studentevaluations`
  ADD PRIMARY KEY (`EvaluationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `teacherperformance`
--
ALTER TABLE `teacherperformance`
  ADD PRIMARY KEY (`PerformanceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clocking`
--
ALTER TABLE `clocking`
  MODIFY `ClockingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `managementevaluations`
--
ALTER TABLE `managementevaluations`
  MODIFY `evaluationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentevaluations`
--
ALTER TABLE `studentevaluations`
  MODIFY `EvaluationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teacherperformance`
--
ALTER TABLE `teacherperformance`
  MODIFY `PerformanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clocking`
--
ALTER TABLE `clocking`
  ADD CONSTRAINT `clocking_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ClassID`);

--
-- Constraints for table `managementevaluations`
--
ALTER TABLE `managementevaluations`
  ADD CONSTRAINT `managementevaluations_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `studentevaluations`
--
ALTER TABLE `studentevaluations`
  ADD CONSTRAINT `studentevaluations_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
