-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 03:40 PM
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
-- Database: `pawtrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(10) NOT NULL,
  `AdminFName` varchar(50) NOT NULL,
  `AdminSName` varchar(50) NOT NULL,
  `AdminEmail` varchar(50) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminLog` varchar(50) DEFAULT NULL,
  `AdminStartDate` date NOT NULL DEFAULT current_timestamp(),
  `AdminPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminFName`, `AdminSName`, `AdminEmail`, `AdminPassword`, `AdminLog`, `AdminStartDate`, `AdminPic`) VALUES
('A001', 'Admin', 'Final', 'admin.final@example.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2023-05-10', 'A_1761130292.jpg'),
('A002', 'Dino', 'Borrinaga', 'dino.borrinaga@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2024-01-22', 'admin2.png'),
('A003', 'admin1', 'admin', 'admin1@pawtrack.com', '$2y$10$e0NRb0XkR2rF5C6jqj1heOP6HkHtOyhdCcz4b5Nw2pReNfQ1k2L5u', 'Active', '2025-10-20', '/assets/images/profile.png'),
('A004', 'da', '', 'test1@gmail.com', '$2y$10$rrWqqQ6AHb4pl3.afwGB4uCqHv9gvVdG/cmG1pdL/Z2sm5EI1d.Uu', NULL, '2025-10-19', '/storage/images/admin/A_1761243003.png'),
('A007', 'Julia', 'Abigail', 'julia.abigail@email.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', NULL, '2024-06-20', 'client2.png'),
('A008', 'Final', 'Test', 'final@example.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', NULL, '2024-05-11', '/storage/images/C/C_1761129693.jpg'),
('A009', 'Admin', 'User', 'admin@pawtrack.com', '$2y$10$H2i6C3HXwre8cE5KCk1AWOhAfVrZyAGKsX54svSbJprVrqxO4gbma', NULL, '2025-10-25', '/assets/images/profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientID` varchar(10) NOT NULL,
  `AdminID` varchar(10) DEFAULT NULL,
  `ClientFName` varchar(50) NOT NULL,
  `ClientLName` varchar(50) NOT NULL,
  `ClientEmail` varchar(50) NOT NULL,
  `ClientPassword` varchar(255) NOT NULL,
  `ClientStartDate` date NOT NULL DEFAULT current_timestamp(),
  `ClientLog` varchar(50) DEFAULT NULL,
  `ClientPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `AdminID`, `ClientFName`, `ClientLName`, `ClientEmail`, `ClientPassword`, `ClientStartDate`, `ClientLog`, `ClientPic`) VALUES
('C001', 'A001', 'Final', 'Test s', 'final@example.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', '2024-05-11', 'Active', '/storage/images/C/C_1761129693.jpg'),
('C002', 'A002', 'Julia', 'Abigail', 'julia.abigail@email.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', '2024-06-20', 'Active', 'client2.png'),
('C003', NULL, 'jay', 'hello', 'jay@email.com', '$2y$10$BZTT./4ldq/33FcD6/ahOOFCTYxgEZajlCKCc3it4aGfTohJm/Tpe', '2025-10-19', 'Active', '/storage/images/C/C_1761362547.jpg'),
('C005', NULL, 'Client', 'User', 'client@email.com', '$2y$10$Fj.GNLLU6Rd9faOwyPUNxe.CVe5vN.J86DSsRlxqROnPNpsvFZSZu', '2025-10-25', 'Active', '/assets/images/profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `medhistory`
--

CREATE TABLE `medhistory` (
  `MedHistoryID` varchar(10) NOT NULL,
  `VetID` varchar(10) NOT NULL,
  `ClientID` varchar(10) NOT NULL,
  `PetID` varchar(10) NOT NULL,
  `MedRecord` varchar(255) NOT NULL,
  `VaxRecord` varchar(255) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medhistory`
--

INSERT INTO `medhistory` (`MedHistoryID`, `VetID`, `ClientID`, `PetID`, `MedRecord`, `VaxRecord`, `Date`) VALUES
('MH001', 'V001', 'C001', 'P001', 'Treated for ear infection, prescribed antibiotics.', 'Rabies (2024), Parvo (2024)', '2025-10-01'),
('MH002', 'V002', 'C002', 'P002', 'Routine check-up, healthy condition.', 'Rabies (2024), Distemper (2024)', '2025-10-03'),
('MH003', 'V001', 'C001', 'P003', 'Minor surgery for wound care.', 'Rabies (2024), Leptospirosis (2024)', '2025-10-04'),
('MH004', 'V002', 'C002', 'P004', 'Diagnosed with mild skin allergy, given ointment.', 'Rabies (2025), Parvo (2025)', '2025-10-11'),
('MH005', 'V001', 'C001', 'P001', 'Follow-up check-up, full recovery observed.', 'Booster: Rabies (2025)', '2025-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `MedicalRecordID` int(11) NOT NULL,
  `PetID` varchar(50) NOT NULL,
  `ClientID` varchar(50) NOT NULL,
  `Diagnosis` varchar(255) NOT NULL,
  `DateDiagnosed` date NOT NULL,
  `Treatment` varchar(255) DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`MedicalRecordID`, `PetID`, `ClientID`, `Diagnosis`, `DateDiagnosed`, `Treatment`, `Notes`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'P002', 'C002', 'asdfsdaf', '2025-10-21', 'asdfsda', 'asdfsdaf', '2025-10-21 10:47:06', '2025-10-21 10:47:06'),
(2, 'P005', 'C003', 'Wala', '2025-10-22', 'asdfs', 'asdfs', '2025-10-21 18:56:44', '2025-10-21 18:56:44'),
(3, 'P005', 'C003', 'Wala', '2025-10-22', 'asdfs', 'asdfs', '2025-10-21 18:56:44', '2025-10-21 18:56:44'),
(4, 'P001', 'C001', 'asdfsadf', '2025-10-23', 'asdfsdaf', 'sadfsdafds', '2025-10-23 08:14:25', '2025-10-23 08:14:25'),
(5, 'P009', 'C003', 'asdfsda', '2025-10-25', 'asdfsdaf', 'asdfsadf', '2025-10-25 03:25:09', '2025-10-25 03:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `PetID` varchar(10) NOT NULL,
  `StaffID` varchar(10) DEFAULT NULL,
  `ClientID` varchar(10) NOT NULL,
  `PetChipNum` varchar(255) DEFAULT NULL,
  `PetName` varchar(50) NOT NULL,
  `Species` varchar(100) DEFAULT NULL,
  `Breed` varchar(100) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Age` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `ColorMarkings` varchar(255) DEFAULT NULL,
  `PetPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`PetID`, `StaffID`, `ClientID`, `PetChipNum`, `PetName`, `Species`, `Breed`, `Gender`, `Age`, `Weight`, `ColorMarkings`, `PetPic`) VALUES
('P001', 'S001', 'C001', '985112009876543', 'Oreo', NULL, NULL, NULL, NULL, NULL, NULL, 'pet1.png'),
('P002', 'S002', 'C002', '985112009123456', 'Mochi', NULL, NULL, NULL, NULL, NULL, NULL, 'pet2.png'),
('P003', 'S002', 'C001', '985112009555555', 'Biscuit', NULL, NULL, NULL, NULL, NULL, NULL, 'pet3.png'),
('P004', 'S001', 'C002', '985112009777777', 'Nala', NULL, NULL, NULL, NULL, NULL, NULL, 'pet4.png'),
('P005', NULL, 'C003', '1512415616124', 'ata', 'cat', 'cat', 'Male', '1', '5', 'red', 'P005_1760969534.jpg'),
('P006', NULL, 'C003', '15124156161245', 'ata', 'cat', 'cat', 'Female', '1', '5', 'red', 'P006_1760969559.jpg'),
('P007', NULL, 'C003', '12498124098120412', 'asjkhfsajkd', 'dskhfkja', 'jkhsdfkjhsda', 'Male', '2', '21', 'sdafsadf', 'P007_1761181834.png'),
('P008', NULL, 'C003', 'sample', 'sample', 'sample', 'samplesample', 'Female', '21', '2', 'red', 'P008_1761207018.jpg'),
('P009', NULL, 'C003', '124123123124123', 'cat', 'cat', 'cat', 'Male', '2', '21', 'cat', 'P009_1761362574.png');

-- --------------------------------------------------------

--
-- Table structure for table `pet_notes`
--

CREATE TABLE `pet_notes` (
  `NoteID` int(11) NOT NULL,
  `PetID` varchar(50) NOT NULL,
  `ClientID` varchar(50) NOT NULL,
  `VisitDate` date NOT NULL,
  `Veterinarian` varchar(100) DEFAULT NULL,
  `Clinic` varchar(100) DEFAULT NULL,
  `VisitType` varchar(100) DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `FollowUpRecommendation` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_notes`
--

INSERT INTO `pet_notes` (`NoteID`, `PetID`, `ClientID`, `VisitDate`, `Veterinarian`, `Clinic`, `VisitType`, `Notes`, `FollowUpRecommendation`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'P002', 'C002', '2025-10-21', 'asdfsda', 'asdfsd', 'sadfsda', 'asdfsda', NULL, '2025-10-21 10:51:35', '2025-10-21 10:51:35'),
(2, 'P002', 'C002', '2025-10-21', 'asdfsda', 'asdfsd', 'sadfsda', 'asdfsda', NULL, '2025-10-21 10:51:35', '2025-10-21 10:51:35'),
(3, 'P002', 'C002', '2025-10-21', 'asdfsdafds', 'sdafasdfsda', 'asdfsdafs', 'sdfsdaf', NULL, '2025-10-21 16:44:09', '2025-10-21 16:44:09'),
(4, 'P002', 'C002', '2025-10-21', 'vet', 'clinic', 'visit', 'note', NULL, '2025-10-21 16:44:55', '2025-10-21 16:44:55'),
(5, 'P002', 'C002', '2025-10-21', 'vet', 'clinic', 'visit', 'note', NULL, '2025-10-21 16:44:55', '2025-10-21 16:44:55'),
(6, 'P002', 'C002', '2025-10-21', 'vet', 'clinic', 'visit', 'note', 'reco', '2025-10-21 16:51:23', '2025-10-21 16:51:23'),
(7, 'P005', 'C003', '2025-10-21', 'asdfsd', 'asdfsad', 'sadfsad', 'asdfsdaf', 'dfdf', '2025-10-21 18:56:53', '2025-10-21 18:56:53'),
(8, 'P005', 'C003', '2025-10-21', 'asdfsd', 'asdfsad', 'sadfsad', 'asdfsdaf', 'dfdf', '2025-10-21 18:56:53', '2025-10-21 18:56:53'),
(9, 'P001', 'C001', '2025-10-23', 'sdfsdf', 'dsfsdf', 'asdfsa', 'sadfsda', 'sdafsda', '2025-10-23 08:14:36', '2025-10-23 08:14:36'),
(10, 'P009', 'C003', '2025-10-25', 'sdfasd', 'sdafsda', 'sdafsda', 'sdfasad', 'sdfsad', '2025-10-25 03:25:33', '2025-10-25 03:25:33'),
(11, 'P009', 'C003', '2025-10-25', 'asdfsdafds', 'dsfdasf', 'sdfasdsfsd', 'asdfsadfsadklfjhasdfhskadjhflksdajhfklashfkjlashdfkljasdhfkljasdhfkljasdhfkljasdhflksdhafkjhdaskljhsdaklfhsd lkasdjfhlksdjah sdakfjhsda flkjsdah flkjsdhf klsjadfhlkk sdh flkjsda lksdhf lksdf lk flkjhsafkjlsdf lksa fkljsh ', 'lkjsdhflk jsah kljasd hlkjsdafh ksdjhf lkjas fksd fkljsd hfklsdhf9iweflsjka flkjwe fkljh flkj kljzsh ilwf lkjsdf ns iluwhf lksdfkjl p', '2025-10-25 03:34:28', '2025-10-25 03:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` varchar(10) NOT NULL,
  `AdminID` varchar(10) NOT NULL,
  `StaffFName` varchar(50) NOT NULL,
  `StaffSName` varchar(50) NOT NULL,
  `StaffEmail` varchar(50) NOT NULL,
  `StaffPassword` varchar(255) NOT NULL,
  `StaffLog` varchar(50) DEFAULT NULL,
  `StaffStartDate` date NOT NULL DEFAULT current_timestamp(),
  `StaffPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `AdminID`, `StaffFName`, `StaffSName`, `StaffEmail`, `StaffPassword`, `StaffLog`, `StaffStartDate`, `StaffPic`) VALUES
('S001', 'A001', 'Paul', 'Gabriel', 'paul.gabriel@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2023-08-05', NULL),
('S002', 'A002', 'Shanen', 'Francesca', 'shanen.francesca@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2024-03-20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_records`
--

CREATE TABLE `vaccination_records` (
  `VaccinationID` int(11) NOT NULL,
  `PetID` varchar(50) NOT NULL,
  `ClientID` varchar(50) NOT NULL,
  `ShotType` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `NextDueDate` date DEFAULT NULL,
  `Veterinarian` varchar(100) DEFAULT NULL,
  `Clinic` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_records`
--

INSERT INTO `vaccination_records` (`VaccinationID`, `PetID`, `ClientID`, `ShotType`, `Date`, `NextDueDate`, `Veterinarian`, `Clinic`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'P002', 'C002', 'dengvaxia', '2025-10-21', '2025-10-31', 'Joseph', 'Mayo', '2025-10-21 10:46:35', '2025-10-21 10:46:35'),
(2, 'P002', 'C002', 'dengvaxia', '2025-10-21', '2025-10-31', 'Joseph', 'Mayo', '2025-10-21 10:46:35', '2025-10-21 10:46:35'),
(3, 'P005', 'C003', 'covi', '2025-10-15', '2025-10-30', 'Dr. Asuncion', 'Mayo', '2025-10-21 18:56:29', '2025-10-21 18:56:29'),
(4, 'P005', 'C003', 'covi', '2025-10-15', '2025-10-30', 'Dr. Asuncion', 'Mayo', '2025-10-21 18:56:29', '2025-10-21 18:56:29'),
(5, 'P002', 'C002', 'covi', '2025-10-23', '2025-10-31', 'sdfgdfs', 'dsfgdfsg', '2025-10-23 01:24:47', '2025-10-23 01:24:47'),
(6, 'P001', 'C001', 'asdfsdf', '2025-10-23', '2025-10-30', 'asdfsad', 'asdfsdaf', '2025-10-23 08:14:11', '2025-10-23 08:14:11'),
(7, 'P001', 'C001', 'asdasda', '0000-00-00', '0000-00-00', 'asfsd', 'asdfsa', '2025-10-25 00:06:15', '2025-10-25 00:06:15'),
(8, 'P009', 'C003', 'test-shot', '2025-10-25', '2025-10-27', 'Dr. Asuncion', 'Mayo', '2025-10-25 03:24:51', '2025-10-25 03:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `vet`
--

CREATE TABLE `vet` (
  `VetID` varchar(10) NOT NULL,
  `AdminID` varchar(10) NOT NULL,
  `VetFName` varchar(50) NOT NULL,
  `VetSName` varchar(50) NOT NULL,
  `VetEmail` varchar(50) NOT NULL,
  `VetPassword` varchar(255) NOT NULL,
  `VetLog` varchar(50) DEFAULT NULL,
  `VetStartDate` date NOT NULL DEFAULT current_timestamp(),
  `VetPic` varchar(255) DEFAULT NULL,
  `VetContact` varchar(20) DEFAULT NULL,
  `VetSpecialization` varchar(100) DEFAULT NULL,
  `VetLicenseNo` varchar(50) DEFAULT NULL,
  `VetExperience` int(11) DEFAULT NULL,
  `ClinicBranch` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vet`
--

INSERT INTO `vet` (`VetID`, `AdminID`, `VetFName`, `VetSName`, `VetEmail`, `VetPassword`, `VetLog`, `VetStartDate`, `VetPic`, `VetContact`, `VetSpecialization`, `VetLicenseNo`, `VetExperience`, `ClinicBranch`) VALUES
('V001', 'A001', 'Shanen', 'Francesca', 'shanen.francesca@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2023-07-01', 'vet-girl.jpg', NULL, NULL, NULL, NULL, NULL),
('V002', 'A002', 'Paul', 'Gabriel', 'paul.gabriel@pawtrack.com', '$2y$10$Sg5gE0/xEZO/4fyynt6DVe3dpvijlJEKger6HUN9ytX5iMC3b6wR6', 'Active', '2024-02-10', 'vet-boy.png', NULL, NULL, NULL, NULL, NULL),
('V008', '', 'Vet', 'User', 'vet@pawtrack.com', '$2y$10$mrQK4g/IlmnNBkZInK41LeWISf3.wUJCxcfotWm3eijFcy0gmva5C', NULL, '2025-10-24', '/storage/images/V/V_1761399486.jpg', '1231231', 'ff', 'fff', 21, 'ff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`),
  ADD UNIQUE KEY `ClientEmail` (`ClientEmail`),
  ADD KEY `admin_client` (`AdminID`);

--
-- Indexes for table `medhistory`
--
ALTER TABLE `medhistory`
  ADD PRIMARY KEY (`MedHistoryID`),
  ADD KEY `client_med` (`ClientID`),
  ADD KEY `pet_med` (`PetID`),
  ADD KEY `vet_med` (`VetID`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`MedicalRecordID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`PetID`),
  ADD KEY `staff_pet` (`StaffID`),
  ADD KEY `client_pet` (`ClientID`);

--
-- Indexes for table `pet_notes`
--
ALTER TABLE `pet_notes`
  ADD PRIMARY KEY (`NoteID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `admin_staff` (`AdminID`);

--
-- Indexes for table `vaccination_records`
--
ALTER TABLE `vaccination_records`
  ADD PRIMARY KEY (`VaccinationID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `vet`
--
ALTER TABLE `vet`
  ADD PRIMARY KEY (`VetID`),
  ADD KEY `admin_vet` (`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `MedicalRecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pet_notes`
--
ALTER TABLE `pet_notes`
  MODIFY `NoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vaccination_records`
--
ALTER TABLE `vaccination_records`
  MODIFY `VaccinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `admin_client` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `medhistory`
--
ALTER TABLE `medhistory`
  ADD CONSTRAINT `client_med` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`),
  ADD CONSTRAINT `pet_med` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`),
  ADD CONSTRAINT `vet_med` FOREIGN KEY (`VetID`) REFERENCES `vet` (`VetID`);

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`),
  ADD CONSTRAINT `medical_records_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `pet` (`ClientID`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `client_pet` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`),
  ADD CONSTRAINT `staff_pet` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`);

--
-- Constraints for table `pet_notes`
--
ALTER TABLE `pet_notes`
  ADD CONSTRAINT `pet_notes_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`),
  ADD CONSTRAINT `pet_notes_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `pet` (`ClientID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `admin_staff` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `vaccination_records`
--
ALTER TABLE `vaccination_records`
  ADD CONSTRAINT `vaccination_records_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`),
  ADD CONSTRAINT `vaccination_records_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `pet` (`ClientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
