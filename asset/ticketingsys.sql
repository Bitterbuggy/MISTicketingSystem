-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 03:42 AM
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
-- Database: `ticketingsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_activitylogs`
--

CREATE TABLE `t_activitylogs` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `activity_type` varchar(35) NOT NULL,
  `activity_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_activitylogs`
--

INSERT INTO `t_activitylogs` (`id`, `UserId`, `activity_type`, `activity_time`) VALUES
(1, 3, 'login', '2025-04-12 22:47:10'),
(2, 3, 'logout', '2025-04-12 22:55:57'),
(3, 3, 'login', '2025-04-12 22:56:09'),
(4, 3, 'logout', '2025-04-12 22:57:57'),
(5, 17, 'login', '2025-04-12 22:59:01'),
(6, 17, 'logout', '2025-04-12 23:00:43'),
(7, 17, 'login', '2025-04-12 23:00:46'),
(8, 17, 'logout', '2025-04-12 23:01:20'),
(9, 3, 'login', '2025-04-12 23:01:24'),
(10, 3, 'logout', '2025-04-12 23:08:40'),
(11, 3, 'login', '2025-04-13 11:57:25'),
(12, 3, 'login', '2025-04-13 21:47:34'),
(13, 3, 'logout', '2025-04-13 23:00:45'),
(14, 3, 'login', '2025-04-20 22:13:35'),
(15, 44, 'login', '2025-04-20 22:30:02'),
(16, 44, 'logout', '2025-04-20 22:30:06'),
(17, 44, 'login', '2025-04-20 23:12:03'),
(18, 44, 'logout', '2025-04-20 23:12:05'),
(19, 44, 'login', '2025-04-20 23:13:17'),
(20, 44, 'logout', '2025-04-20 23:13:19'),
(21, 44, 'login', '2025-04-20 23:13:34'),
(22, 44, 'logout', '2025-04-20 23:15:47'),
(23, 3, 'login', '2025-04-20 23:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `AdminId` varchar(25) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`AdminId`, `UserId`, `Position`, `Department`) VALUES
('admin_67e22850c68bf', 3, '', ''),
('admin_67e238412f47f', 4, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_asset`
--

CREATE TABLE `t_asset` (
  `AssetId` int(11) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `AssetName` varchar(55) NOT NULL,
  `AssetTypeId` int(11) NOT NULL,
  `SerialNumber` varchar(55) DEFAULT NULL,
  `PurchasedDate` date DEFAULT NULL,
  `AssetStatus` enum('Available','In Use','Maintenance','Disposed','Transferred','Transfer Request') DEFAULT 'In Use',
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_assettransfer`
--

CREATE TABLE `t_assettransfer` (
  `TransferId` int(11) NOT NULL,
  `AssetId` int(11) NOT NULL,
  `fromBranchId` int(11) NOT NULL,
  `toBranchId` int(11) NOT NULL,
  `requestedByBranchAdminId` varchar(25) NOT NULL,
  `approvedByITstaffId` varchar(30) DEFAULT NULL,
  `requestDate` date DEFAULT NULL,
  `transferDate` date DEFAULT NULL,
  `transferStatus` enum('Pending','Approved','Rejected','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `t_assettransfer`
--
DELIMITER $$
CREATE TRIGGER `after_transfer_request` AFTER INSERT ON `t_assettransfer` FOR EACH ROW BEGIN
    UPDATE t_asset
    SET AssetStatus = 'Transfer Request'
    WHERE AssetId = NEW.AssetId;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_transfer_update` AFTER UPDATE ON `t_assettransfer` FOR EACH ROW BEGIN
	/*If transfer   is approved but not yet completed*/
    IF NEW.TransferStatus = 'Approved' THEN
    	UPDATE t_asset
        SET AssetStatus = 'Transfer Request'
        WHERE AssetId = NEW.AssetId;
    END IF; 

	/*If transfer is marked as completed */
    IF NEW.TransferStatus = 'Completed' THEN 
    	UPDATE t_asset
        SET AssetStatus = 'Transferred'
        WHERE AssetId = NEW.AssetId;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_assettype`
--

CREATE TABLE `t_assettype` (
  `AssetTypeId` int(11) NOT NULL,
  `AssetTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_branch`
--

CREATE TABLE `t_branch` (
  `BranchId` int(11) NOT NULL,
  `BranchName` varchar(50) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `Location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_branch`
--

INSERT INTO `t_branch` (`BranchId`, `BranchName`, `DistrictId`, `Location`) VALUES
(1, 'Balingasa', 1, 'Second floor, Crisologo Building\r\nBarangay Balingasa, Quezon City'),
(2, 'Masambong ', 2, 'Masambong Multi-Purpose Building, 04 Capoas, Lungsod Quezon, Kalakhang Maynila, Philippines'),
(3, 'Nayong Kanluran ', 3, '2nd Floor Bagong Henerasyon “BH” Center, 37 Sorsogon Street, Barangay Nayong Kanluran, Quezon City, Metro Manila 1104'),
(4, 'NS Amoranto ', 4, 'Mayon Avenue, Brgy. NS Amoranto, Quezon City'),
(5, 'Project 7', 5, 'Bansalangin corner Palomaria Streets\r\nBarangay Veterans, Quezon City'),
(6, 'Project 8 ', 6, 'Road 15 corner Road 19\r\nBarangay Bahay Toro, Quezon City'),
(7, 'Book Nook (WalterMart-NE)', 7, '3rd floor of WalterMart North Edsa'),
(8, 'Bagong Pagasa', 8, 'Road 9, Barangay Bagong Pag-asa, Quezon City'),
(9, 'Payatas Lupang Pangako ', 9, 'Barangay Payatas, Quezon City'),
(10, 'Bagong Silangan', 10, '2nd Floor Susano Building, 570- A Bonifacio Street, corner Gen. Villamor, Quezon City, 1119 Metro Manila, Philippines'),
(11, 'Holy Spirit', 11, 'No. 6 Faustino St., Isidora Hills Subd., Brgy. Holy Spirit, District 2, Quezon City'),
(12, 'MRB Commonwealth', 12, 'Pilot St. corner Rotary, MRB Building, Barangay Commonwealth, Quezon City'),
(13, 'Payatas Landfill', 13, 'Clemente Street, Phase 3 Barangay Payatas B, Quezon City, Metro Manila 1119'),
(14, 'Greater Project 4', 19, 'A. Luna 58 1109 Quezon City National Capital Region'),
(15, 'Tagumpay', 20, '2B P. Tuazon Boulevard, Barangay Tagumpay, Cubao, Quezon City, Metro Manila 1109'),
(16, 'Libis', 21, 'Libis, Quezon City, National Capital Region, Philippines'),
(17, 'Matandang Balara', 22, 'Bistek Ville 20 Villa Beatriz, Barangay Matandang Balara.'),
(18, 'Escopa 2', 23, 'Barangay Escopa 2, Quezon City'),
(19, 'Escopa 3', 24, 'Barangay Escopa 3 PUD Site Bliss, Barangay Covered Court, Quezon City'),
(20, 'Cubao', 25, 'Ground floor, Lion\'s International Building\r\nBarangay Kamuning, Quezon City'),
(21, 'Krus na Ligas', 26, 'Second floor, Daza Hall\r\nBarangay Krus na Ligas, Quezon City'),
(22, 'San Isidro Galas', 27, 'Second floor, Barangay Hall\r\nBarangay San Isidro-Galas, Quezon City'),
(23, 'ROXAS', 28, 'Jasmin Street\r\nBarangay Roxas, Quezon City'),
(24, 'UP Campus Pook Amorsolo', 29, 'Diliman,\r\nQuezon City'),
(25, 'UP Campus Pook Dagohoy', 30, 'Diliman,\r\nQuezon City'),
(26, 'Lagro', 31, 'Greater Lagro Plaza\r\nBarangay Pasong Putik, Quezon City'),
(27, 'North Fairview', 32, '3rd Floor Barangay Hall, Brookside Street corner Brimley Street, Fairview Homes, Barangay North Fairview, Quezon City, Metro Manila 1121'),
(28, 'Novaliches', 33, 'SB Library Bldg., Quirino Highway\r\nNovaliches, Quezon City'),
(29, 'Pasong Tamo', 34, 'Diego Silang St\r\nBarangay Pasong Tamo, Quezon City'),
(30, 'Talipapa', 35, 'Quirino Highway, Barangay Talipapa, Quezon City'),
(31, 'Sagana', 36, 'Sagana Homes, Block 1 Lot 3 1 Subdivision, Quezon City, Metro Manila, Philippines'),
(32, 'Tandang Sora', 37, 'Tandang Sora, Quezon City'),
(33, 'QCPL Main Branch', 38, 'Mayaman Street,\r\nBarangay Central, Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `t_branchadmin`
--

CREATE TABLE `t_branchadmin` (
  `BranchAdminId` varchar(25) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_branchadmin`
--

INSERT INTO `t_branchadmin` (`BranchAdminId`, `UserId`, `Position`, `Department`) VALUES
('branchadmin_67e25600a2f6f', 8, '', ''),
('branchadmin_67e2622bb1caa', 14, '', ''),
('branchadmin_67e2628ad853f', 15, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_district`
--

CREATE TABLE `t_district` (
  `DistrictId` int(11) NOT NULL,
  `DistrictNo` varchar(25) DEFAULT NULL,
  `DistricTName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_district`
--

INSERT INTO `t_district` (`DistrictId`, `DistrictNo`, `DistricTName`) VALUES
(1, 'District 1 ', 'Balingasa'),
(2, 'District 1 ', 'Masambong'),
(3, 'District 1 ', 'Nayong Kanluran '),
(4, 'District 1 ', 'NS Amoranto '),
(5, 'District 1 ', 'Project 7 '),
(6, 'District 1 ', 'Project 8 '),
(7, 'District 1', 'Book Nook(WalterMart'),
(8, 'District 1', 'Bagong Pagasa '),
(9, 'District 2 ', 'Payatas Lupang Pangako '),
(10, 'District 2', 'Bagong Silangan '),
(11, 'District 2', 'Holy Spirit '),
(12, 'District 2', 'MRB Commonwealth '),
(13, 'District 2 ', 'Payatas Landfill'),
(19, 'District 3 ', 'Greater Project 4 '),
(20, 'District 3 ', 'Tagumpay '),
(21, 'District 3 ', 'Libis '),
(22, 'District 3 ', 'Matandang Balara '),
(23, 'District 3 ', 'Escopa 2 '),
(24, 'District 3', 'Escopa 3 '),
(25, 'District 4 ', 'Cubao '),
(26, 'District 4', 'Krus na Ligas '),
(27, 'District 4 ', 'San Isidro Galas '),
(28, 'District 4 ', 'ROXAS'),
(29, 'District 4', 'UP Campus Pook Amorsolo'),
(30, 'District 4 ', 'UP Campus Pook Dagohoy '),
(31, 'District 5 ', 'Lagro '),
(32, 'District 5', 'North Fairview '),
(33, 'District 5 ', 'Novaliches '),
(34, 'District 6 ', 'Pasong Tamo '),
(35, 'District 6 ', 'Talipapa '),
(36, 'District 6', 'Sagana '),
(37, 'District 6', 'Tandang Sora '),
(38, 'District 4', 'QCPL Main Branch ');

-- --------------------------------------------------------

--
-- Table structure for table `t_issuedsubtype`
--

CREATE TABLE `t_issuedsubtype` (
  `SubtypeId` int(11) NOT NULL,
  `IssueId` int(11) NOT NULL,
  `SubtypeName` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_issuedtype`
--

CREATE TABLE `t_issuedtype` (
  `IssueId` int(11) NOT NULL,
  `IssueType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_itstaff`
--

CREATE TABLE `t_itstaff` (
  `ITstaffId` varchar(30) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_itstaff`
--

INSERT INTO `t_itstaff` (`ITstaffId`, `UserId`, `Position`, `Department`) VALUES
('itstaff_67e258517c98b', 12, '', ''),
('itstaff_67e264a751378', 17, '', ''),
('itstaff_67e4064c87240', 20, '', ''),
('itstaff_67e42413ad043', 33, '', ''),
('itstaff_67ec447925949', 34, '', ''),
('itstaff_67ec46b7e54d0', 35, '', ''),
('itstaff_67f56f6c640cf', 37, '', ''),
('itstaff_67f57291dcd77', 38, '', ''),
('itstaff_67f82156eb472', 39, '', ''),
('itstaff_67f82c53c8d38', 44, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_notifs`
--

CREATE TABLE `t_notifs` (
  `NotifId` int(11) NOT NULL,
  `NotifType` enum('Ticket','Transfer') DEFAULT NULL,
  `ReferencesId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `NotifMessage` text DEFAULT NULL,
  `Notifstatus` enum('Unread','Read') DEFAULT 'Unread',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_roles`
--

CREATE TABLE `t_roles` (
  `RoleId` int(11) NOT NULL,
  `RoleName` enum('UserEmp','ITstaff','BranchAdmin','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_roles`
--

INSERT INTO `t_roles` (`RoleId`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'BranchAdmin'),
(3, 'ITstaff'),
(4, 'UserEmp');

-- --------------------------------------------------------

--
-- Table structure for table `t_tickets`
--

CREATE TABLE `t_tickets` (
  `TicketsId` int(11) NOT NULL,
  `EmployeeId` varchar(20) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `AssignedITstaffId` varchar(30) DEFAULT NULL,
  `AssetId` int(11) NOT NULL,
  `IssueId` int(11) NOT NULL,
  `SubtypeId` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `TicketStatus` enum('Pending','Completed','Ongoing','Cancelled') DEFAULT 'Pending',
  `Priority` enum('Low','Medium','High') DEFAULT 'Low',
  `TimeSubmitted` timestamp NOT NULL DEFAULT current_timestamp(),
  `TimeResolved` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `t_tickets`
--
DELIMITER $$
CREATE TRIGGER `update_ticket_priority` BEFORE UPDATE ON `t_tickets` FOR EACH ROW BEGIN
    -- Check if the status is 'Pending' and it's more than 7 days since created
    IF NEW.TicketStatus = 'Pending' AND DATEDIFF(CURRENT_DATE, NEW.TimeSubmitted) > 7 THEN
        SET NEW.Priority = 'High';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_useremp`
--

CREATE TABLE `t_useremp` (
  `EmployeeId` varchar(20) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_useremp`
--

INSERT INTO `t_useremp` (`EmployeeId`, `UserId`, `Position`, `Department`) VALUES
('employee_67e2590d7a6', 13, '', ''),
('employee_67e26713d38', 18, '', ''),
('employee_67e267733e5', 19, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Contactno` int(11) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `RoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`UserId`, `FirstName`, `LastName`, `Email`, `Contactno`, `DistrictId`, `BranchId`, `Password`, `RoleId`) VALUES
(3, 'Admin', 'Admin', 'Admin@mail.com', 2147483647, 1, 1, '$2y$10$cd1FcVDTwR/Q8PM5FX3J3ughe3huyJMDVWjkNJpTCXk45FJzJHmhC', 1),
(4, 'Admin', 'Admin', 'Admin@mail.com', 2147483647, 4, 4, '$2y$10$5tj.MmZUTemTxquLCKJwgOUM1e4aj6QKHlM6ond/gl3FLSXrCqpg2', 1),
(6, 'LIC', 'LIC', 'Lic@mail.com', 2147483647, 4, 4, '$2y$10$BQNKDVqJPPFziojmDWRMguqTIC37xo2n/SkxEwDRYJqj0vVxh0bAe', 2),
(7, 'LIC', 'LIC', 'Lic@mail.com', 2147483647, 4, 4, '$2y$10$NQ6Zjk8CvuSkXBFA/P0zhuukjKy.AX9h/oqUsGCnqLIPiUl9jGxZ2', 2),
(8, 'LIC', 'LIC', 'Lic@mail.com', 2147483647, 4, 4, '$2y$10$gzve6w4uX1TwEHF/eHuvH.ytYxt3IzJk8Vu1jKih77urGjG1wjU6.', 2),
(11, 'IT', 'staff', 'ITstaff@mail.com', 2147483647, 10, 10, '$2y$10$TTygKQQfMRpeSrXgLbb3MOR84O/laPX3cti8/YGRhd9cDhVM3YlWe', 3),
(12, 'IT', 'staff', 'ITstaff@mail.com', 2147483647, 10, 10, '$2y$10$IikVPLRwrfqfMnl6BbQw5.pi4kCO1KKQpIvXPuUMyt.5kU9ZnU9T6', 3),
(13, 'employeesample', 'sample', 'Employee@mail.com', 2147483647, 19, 19, '$2y$10$a5rVr1wRAfu8jpByHnKuJORaqOLgd1o2y3xNXuvGN1qcb6PUDpkEy', 4),
(14, 'Ash', 'LIC', 'Lic@mail.com', 2147483647, 5, 5, '$2y$10$LFZ9vjbbZbwQ0jVrWzsgZOyGxNVWeZg43iPsVCpqRGFgGlvZ1S24q', 2),
(15, 'Ash', 'LIC', 'LicAsh@mail.com', 2147483647, 5, 5, '$2y$10$82gGKhomqPGfWCzJNRVV8.amrv8IllSR16A.TZGM8Tb3lCAg9D4da', 2),
(17, 'Hyas', 'ITstaff', 'ITstaff1@mail.com', 2147483647, 21, 21, '$2y$10$3GHnYvY7BenxeTGZARU6pOknwPtuxuKC84aOOJlYq2hvGxA9hi3Ja', 3),
(18, 'Ashley', 'delaCruz', 'Aldehalseymeows@mail.com', 2147483647, 25, 25, '$2y$10$Pa.0/DSMaqWmywbpBpHZyuQfDll8fV6YdIg0pGq9NczDjU7MpEJVy', 4),
(19, 'Ashley1', 'delaCruz', 'Aldehalseymeows1@mail.com', 2147483647, 25, 25, '$2y$10$9aTohvc0RjffZtHOppFGdOGe4yqjjZpKeHvB3fwOKfOmwnnbqjiUS', 4),
(20, 'Mika ', 'Garcia', 'MikaGarcia@mail.com', 2147483647, 29, 29, '$2y$10$VW0PC9IFBAjaPj/.Xm7ZV.C6gqmQ34HuxDXGdQDyCtQgiIkgpTTk6', 3),
(33, 'Ria', 'Santos', 'RiaSantos@mail.com', 2147483647, 25, 20, '$2y$10$xvQKc2S8sQFPGAgHuS0equYMsM9JOU98uWZnnE/l1fzfrA5qaE9Pq', 3),
(34, 'Eziell', 'Villamor', 'ITstaff3@mail.com', 2147483647, 27, 22, '$2y$10$xeKLz5a9M341Yf9Z8NCqEOmx/jBcnpoNFcoD7DzpykQ.UWHTEsG7y', 3),
(35, 'Jhulius', 'dela Cruz', 'Jhuliusdella@mail.com', 2147483647, 24, 19, '$2y$10$Ucp.k.rgwgjxlL6NxXkbV.oRsh2bTW.c6Cn5TXN5YuxQSXhEeik9a', 3),
(37, 'Asha Rae', 'Garcia', 'ashleydelacruzasc01@gmail.com', 2147483647, 28, 23, '$2y$10$H2/lm5vTOS.p7MyVgDNciejTocNT5tRisaXqJdydRBrr7DxErKk6.', 3),
(38, 'Jhulius Kae', 'delaCruz', 'jhuliusdelacruzjdc10@gmail.com', 2147483647, 28, 23, '$2y$10$7AVUBbtSRL1RXcbxHOBlnu/l/Y742cyvBHMKgh2A1BaAhn4tyLal6', 3),
(39, 'Rico', 'Pajarillo', 'pajarillorico@gmail.com', 2147483647, 21, 16, '$2y$10$3V0ihIqbtKRyae0D0wrIXeLxboEWdKuiXYzJr4DZnU70hlgszXKNm', 3),
(44, 'Fal', 'dawnas', 'halseyaldecruz@gmail.com', 2147483647, 21, 16, '$2y$10$gFLGZCLjOn5NuH13r/vHrenJe0Xp8/HvrcpovRFCojhBrSJKe1TZS', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_activitylogs`
--
ALTER TABLE `t_activitylogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`AdminId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_asset`
--
ALTER TABLE `t_asset`
  ADD PRIMARY KEY (`AssetId`);

--
-- Indexes for table `t_assettransfer`
--
ALTER TABLE `t_assettransfer`
  ADD PRIMARY KEY (`TransferId`),
  ADD KEY `AssetId` (`AssetId`),
  ADD KEY `fromBranchId` (`fromBranchId`),
  ADD KEY `toBranchId` (`toBranchId`),
  ADD KEY `requestedByBranchAdminId` (`requestedByBranchAdminId`),
  ADD KEY `approvedByITstaffId` (`approvedByITstaffId`);

--
-- Indexes for table `t_assettype`
--
ALTER TABLE `t_assettype`
  ADD PRIMARY KEY (`AssetTypeId`);

--
-- Indexes for table `t_branch`
--
ALTER TABLE `t_branch`
  ADD PRIMARY KEY (`BranchId`),
  ADD KEY `DistrictId` (`DistrictId`);

--
-- Indexes for table `t_branchadmin`
--
ALTER TABLE `t_branchadmin`
  ADD PRIMARY KEY (`BranchAdminId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_district`
--
ALTER TABLE `t_district`
  ADD PRIMARY KEY (`DistrictId`);

--
-- Indexes for table `t_issuedsubtype`
--
ALTER TABLE `t_issuedsubtype`
  ADD PRIMARY KEY (`SubtypeId`);

--
-- Indexes for table `t_issuedtype`
--
ALTER TABLE `t_issuedtype`
  ADD PRIMARY KEY (`IssueId`);

--
-- Indexes for table `t_itstaff`
--
ALTER TABLE `t_itstaff`
  ADD PRIMARY KEY (`ITstaffId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_notifs`
--
ALTER TABLE `t_notifs`
  ADD PRIMARY KEY (`NotifId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `t_tickets`
--
ALTER TABLE `t_tickets`
  ADD PRIMARY KEY (`TicketsId`),
  ADD KEY `EmployeeId` (`EmployeeId`),
  ADD KEY `BranchId` (`BranchId`),
  ADD KEY `DistrictId` (`DistrictId`),
  ADD KEY `AssignedITstaffId` (`AssignedITstaffId`),
  ADD KEY `AssetId` (`AssetId`),
  ADD KEY `IssueId` (`IssueId`),
  ADD KEY `SubtypeId` (`SubtypeId`);

--
-- Indexes for table `t_useremp`
--
ALTER TABLE `t_useremp`
  ADD PRIMARY KEY (`EmployeeId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `DistrictId` (`DistrictId`),
  ADD KEY `BranchId` (`BranchId`),
  ADD KEY `RoleId` (`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_activitylogs`
--
ALTER TABLE `t_activitylogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_asset`
--
ALTER TABLE `t_asset`
  MODIFY `AssetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_assettransfer`
--
ALTER TABLE `t_assettransfer`
  MODIFY `TransferId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_assettype`
--
ALTER TABLE `t_assettype`
  MODIFY `AssetTypeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_branch`
--
ALTER TABLE `t_branch`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `t_district`
--
ALTER TABLE `t_district`
  MODIFY `DistrictId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `t_issuedsubtype`
--
ALTER TABLE `t_issuedsubtype`
  MODIFY `SubtypeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_issuedtype`
--
ALTER TABLE `t_issuedtype`
  MODIFY `IssueId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_notifs`
--
ALTER TABLE `t_notifs`
  MODIFY `NotifId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_tickets`
--
ALTER TABLE `t_tickets`
  MODIFY `TicketsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_activitylogs`
--
ALTER TABLE `t_activitylogs`
  ADD CONSTRAINT `t_activitylogs_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD CONSTRAINT `t_admin_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_assettransfer`
--
ALTER TABLE `t_assettransfer`
  ADD CONSTRAINT `t_assettransfer_ibfk_1` FOREIGN KEY (`AssetId`) REFERENCES `t_asset` (`AssetId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_assettransfer_ibfk_2` FOREIGN KEY (`fromBranchId`) REFERENCES `t_branch` (`BranchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_assettransfer_ibfk_3` FOREIGN KEY (`toBranchId`) REFERENCES `t_branch` (`BranchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_assettransfer_ibfk_4` FOREIGN KEY (`requestedByBranchAdminId`) REFERENCES `t_branchadmin` (`BranchAdminId`),
  ADD CONSTRAINT `t_assettransfer_ibfk_5` FOREIGN KEY (`approvedByITstaffId`) REFERENCES `t_itstaff` (`ITstaffId`);

--
-- Constraints for table `t_branch`
--
ALTER TABLE `t_branch`
  ADD CONSTRAINT `t_branch_ibfk_1` FOREIGN KEY (`DistrictId`) REFERENCES `t_district` (`DistrictId`);

--
-- Constraints for table `t_branchadmin`
--
ALTER TABLE `t_branchadmin`
  ADD CONSTRAINT `t_branchadmin_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_itstaff`
--
ALTER TABLE `t_itstaff`
  ADD CONSTRAINT `t_itstaff_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_notifs`
--
ALTER TABLE `t_notifs`
  ADD CONSTRAINT `t_notifs_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_tickets`
--
ALTER TABLE `t_tickets`
  ADD CONSTRAINT `t_tickets_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `t_useremp` (`EmployeeId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_2` FOREIGN KEY (`BranchId`) REFERENCES `t_branch` (`BranchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_3` FOREIGN KEY (`DistrictId`) REFERENCES `t_district` (`DistrictId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_4` FOREIGN KEY (`AssignedITstaffId`) REFERENCES `t_itstaff` (`ITstaffId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_5` FOREIGN KEY (`AssetId`) REFERENCES `t_asset` (`AssetId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_6` FOREIGN KEY (`IssueId`) REFERENCES `t_issuedtype` (`IssueId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_7` FOREIGN KEY (`SubtypeId`) REFERENCES `t_issuedsubtype` (`SubtypeId`) ON DELETE CASCADE;

--
-- Constraints for table `t_useremp`
--
ALTER TABLE `t_useremp`
  ADD CONSTRAINT `t_useremp_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`) ON DELETE CASCADE;

--
-- Constraints for table `t_users`
--
ALTER TABLE `t_users`
  ADD CONSTRAINT `t_users_ibfk_1` FOREIGN KEY (`DistrictId`) REFERENCES `t_district` (`DistrictId`),
  ADD CONSTRAINT `t_users_ibfk_2` FOREIGN KEY (`BranchId`) REFERENCES `t_branch` (`BranchId`),
  ADD CONSTRAINT `t_users_ibfk_3` FOREIGN KEY (`RoleId`) REFERENCES `t_roles` (`RoleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
