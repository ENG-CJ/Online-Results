-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 03:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `addStudent` (IN `$roll` VARCHAR(50), IN `$name` VARCHAR(100), IN `$gender` VARCHAR(60), IN `$mobile` INT, IN `$address` VARCHAR(50), IN `$class` VARCHAR(50), IN `$semester` VARCHAR(50))   BEGIN
 
INSERT INTO students(`RollNumber`,`FullName`,`Gender`,`Mobile`,`Address`,`Class`,`Semester`)
VALUES($roll,$name,$gender,$mobile,$address,$class,$semester);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addSubject` (IN `$name` VARCHAR(100), IN `$semesterName` VARCHAR(100))   BEGIN
 INSERT INTO subjects(`Name`,`Belongs_Semester`) VALUES($name,$semesterName);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_class` (IN `Class_id` VARCHAR(55), IN `className` VARCHAR(55))   BEGIN
INSERT INTO `classes`(`classID`, `Name`)
VALUES ($Class_id,$className);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_simester` (IN `ID` VARCHAR(55), IN `Name` VARCHAR(55))   BEGIN
INSERT INTO `simester`(`ID`, `Name`)  
VALUES (ID,Name);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user` (IN `$user_id` VARCHAR(50), IN `$username` VARCHAR(100), IN `$pass` VARCHAR(100), IN `$role` VARCHAR(50), IN `$status` VARCHAR(50))   BEGIN
INSERT INTO `users`(`ID`, `Username`, `Password`, `User_Type`, `Status`) 
VALUES ($user_id,$username,$pass,$role,$status);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countStudents` ()   BEGIN

SELECT COUNT(*) as 'Rows' FROM students;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countUsers` ()   BEGIN

SELECT COUNT(*) as 'Rows' FROM users ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteStudent` (IN `$id` VARCHAR(100))   BEGIN
 DELETE FROM students WHERE students.RollNumber=$id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSubject` (IN `$id` INT)   BEGIN
 DELETE FROM subjects 
 WHERE subjects.SubjectID=$id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_sp` (IN `$id` VARCHAR(50))   BEGIN
 DELETE FROM users WHERE users.ID=$id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ExistStudent` (IN `$roll` VARCHAR(50), IN `$mobile` INT)   BEGIN
SELECT *FROM students
WHERE students.RollNumber=$roll or students.Mobile=$mobile;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readClassNames` ()   BEGIN
SELECT classes.Name FROM classes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readSemesterName` ()   BEGIN
 SELECT simester.Name as Semester
 from simester;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readStudents` ()   BEGIN

SELECT *FROM students;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readSubjects` ()   BEGIN
 SELECT *FROM subjects;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readUsers` ()   BEGIN
 SELECT users.ID, users.Username,users.User_Type as Role, users.Status,users.JoinedDate FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchSemesterName` (IN `$name` VARCHAR(100))   BEGIN
 SELECT simester.Name FROM simester
 WHERE simester.Name=$name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStudent` (IN `$id` VARCHAR(50), IN `$name` VARCHAR(100), IN `$gender` VARCHAR(80), IN `$mobile` INT, IN `$address` VARCHAR(50), IN `$class` VARCHAR(50), IN `$semester` VARCHAR(50), IN `$updateID` VARCHAR(50))   BEGIN
UPDATE students SET students.RollNumber=$id,
students.FullName=$name, students.Gender=$gender,

students.Mobile=$mobile,students.Address=$address,
students.Class=$class,students.Semester=$semester
WHERE students.RollNumber=$updateID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateSubject` (IN `$name` VARCHAR(100), IN `$semesterName` VARCHAR(100), IN `$id` INT)   BEGIN
UPDATE subjects SET subjects.Name=$name, subjects.Belongs_Semester=$semesterName
WHERE subjects.SubjectID=$id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_class` (IN `clasid` VARCHAR(55), IN `className` VARCHAR(55), IN `update_id` VARCHAR(55))   BEGIN

UPDATE `classes` SET `classID`=clasid,`Name`=className WHERE classes.classID=update_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_simister` (IN `ID` VARCHAR(55), IN `Name` VARCHAR(55), IN `update_id` VARCHAR(55))   BEGIN

UPDATE simester SET `ID`=ID,`Name`=Name WHERE simester.ID=update_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user` (IN `$user_id` VARCHAR(100), IN `$username` VARCHAR(100), IN `$pass` VARCHAR(80), IN `$role` VARCHAR(50), IN `$status` VARCHAR(50), IN `$update_id` VARCHAR(100))   BEGIN

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
('C001', 'CA209', '2022-08-19 14:57:01');

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
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `RollNumber` varchar(80) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Gender` varchar(40) NOT NULL,
  `Mobile` int(70) NOT NULL,
  `Address` varchar(70) NOT NULL,
  `Class` varchar(60) NOT NULL,
  `Semester` varchar(60) NOT NULL,
  `RegisteredDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RollNumber`, `FullName`, `Gender`, `Mobile`, `Address`, `Class`, `Semester`, `RegisteredDate`) VALUES
('ST1200', 'Salim', 'Female', 78878, 'Somalia', 'CA209', 'ONE', '2022-08-21 09:06:47'),
('ST1201', 'Farah', 'Female', 1910220190, 'Somalia', 'CA209', 'TWO', '2022-08-21 09:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL,
  `Name` varchar(90) NOT NULL,
  `Belongs_Semester` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SubjectID`, `Name`, `Belongs_Semester`) VALUES
(8, 'SQL SERVER2', 'ONE'),
(9, 'Mysql', 'FIVE');

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
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SubjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
