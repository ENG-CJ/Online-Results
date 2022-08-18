-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2022 at 03:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justresults`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_class` (IN `Class_id` VARCHAR(55), IN `className` VARCHAR(55))  BEGIN
INSERT INTO `classes`(`classID`, `Name`)
VALUES ($Class_id,$className);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_simester` (IN `ID` VARCHAR(55), IN `Name` VARCHAR(55))  BEGIN
INSERT INTO `simester`(`ID`, `Name`)  
VALUES (ID,Name);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user` (IN `$user_id` VARCHAR(50), IN `$username` VARCHAR(100), IN `$pass` VARCHAR(100), IN `$role` VARCHAR(50), IN `$status` VARCHAR(50))  BEGIN
INSERT INTO `users`(`ID`, `Username`, `Password`, `User_Type`, `Status`) 
VALUES ($user_id,$username,$pass,$role,$status);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countUsers` ()  BEGIN

SELECT COUNT(*) as 'Rows' FROM users ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_sp` (IN `$id` VARCHAR(50))  BEGIN
 DELETE FROM users WHERE users.ID=$id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readUsers` ()  BEGIN
 SELECT users.ID, users.Username,users.User_Type as Role, users.Status,users.JoinedDate FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_class` (IN `clasid` VARCHAR(55), IN `className` VARCHAR(55), IN `update_id` VARCHAR(55))  BEGIN

UPDATE `classes` SET `classID`=clasid,`Name`=className WHERE classes.classID=update_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_simister` (IN `ID` VARCHAR(55), IN `Name` VARCHAR(55), IN `update_id` VARCHAR(55))  BEGIN

UPDATE simester SET `ID`=ID,`Name`=Name WHERE simester.ID=update_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user` (IN `$user_id` VARCHAR(100), IN `$username` VARCHAR(100), IN `$pass` VARCHAR(80), IN `$role` VARCHAR(50), IN `$status` VARCHAR(50), IN `$update_id` VARCHAR(100))  BEGIN

UPDATE `users` SET `ID`=$user_id,`Username`=$username,`Password`=$pass,`User_Type`=$role,
`Status`=$status WHERE users.ID=$update_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `Name` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `Name`, `date`) VALUES
('C120913', 'CA202', '2022-08-15 11:45:28'),
('c120149', 'CA201', '2022-08-15 13:16:07'),
('C120930', 'CA203', '2022-08-15 13:17:11'),
('C12019', 'CA202', '2022-08-15 13:16:55'),
('C1201928', 'CA210', '2022-08-15 13:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `simester`
--

CREATE TABLE `simester` (
  `ID` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `Name` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `simester`
--

INSERT INTO `simester` (`ID`, `Name`, `date`) VALUES
('A001', 'ONE', '2022-08-15 12:58:10'),
('A002', 'TWO', '2022-08-15 12:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(30) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `JoinedDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `User_Type`, `Status`, `JoinedDate`) VALUES
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14'),
('US002', 'Halima', '09021L', 'admin', 'Blocked', '2022-08-15 09:41:41'),
('US003', 'mesud', 'maska', 'admin', 'active', '2022-08-15 13:14:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
