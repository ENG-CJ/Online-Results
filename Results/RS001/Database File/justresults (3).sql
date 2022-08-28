-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 09:47 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMarks` (IN `$subjectID` INT, IN `$resultID` INT, IN `$marks` INT)   BEGIN
 INSERT INTO marks(`SubjectID`,`ResultID`,`marks`)
 VALUES($subjectID,$resultID,$marks);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddResult` (IN `$semesterID` VARCHAR(100), IN `$studentID` VARCHAR(100), IN `$publish` VARCHAR(30), IN `$precentage` FLOAT(4,2), IN `$status` VARCHAR(50), IN `$class` VARCHAR(50))   BEGIN
 INSERT INTO results(`SemesterID`,`StudentID`,`Published`,`Precentage`,`Status`,`Class`)
 VALUES($semesterID,$studentID,$precentage,$publish,$status,$class);
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_combanetion` (IN `username` VARCHAR(55), IN `bassword` VARCHAR(55), IN `role` VARCHAR(55), IN `status` VARCHAR(55), IN `student` VARCHAR(55))   BEGIN
IF (role ='student')THEN
INSERT INTO `combanition`( `username`, `bassword`, `role`, `status`)
VALUES (student,bassword,role,status);

SELECT 'Deny'as Message;
ELSE
INSERT INTO `combanition`( `username`, `bassword`, `role`, `status`)
VALUES (username,bassword,role,status);

SELECT 'Regestered'as Message;
END IF;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteResults` (IN `$id` INT)   BEGIN
DELETE FROM results WHERE results.result_id=$id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchStudents` (IN `$className` VARCHAR(100), IN `$semesterName` VARCHAR(100))   BEGIN
   SELECT *FROM students
   WHERE students.Class=$className AND students.Semester=$semesterName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchSubjects` (IN `$semester` VARCHAR(50))   BEGIN
SELECT  subjects.SubjectID,subjects.Name FROM subjects
INNER JOIN simester ON subjects.Belongs_Semester=simester.Name
WHERE simester.Name=$semester
ORDER BY simester.Name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `findUser` (IN `$username` VARCHAR(100), IN `$pass` VARCHAR(100))   BEGIN
 SELECT *FROM users
 WHERE users.Username=$username AND users.Password=$pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PassAndFail_Visual` (IN `$class` VARCHAR(70), IN `$semester` VARCHAR(70))   BEGIN

SELECT results.Decision, COUNT(results.Decision) as Perecentage FROM results
WHERE results.SemesterID=$semester AND results.Class=$class
GROUP BY results.Decision;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readClassNames` ()   BEGIN
SELECT classes.Name FROM classes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readResult` ()   BEGIN
SELECT  results.result_id as ResultID ,
results.SemesterID as Semester,students.FullName,
results.Precentage,results.Status,results.Published,
results.DateAdded
FROM results
INNER JOIN students on results.StudentID=students.RollNumber;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readSemesterName` ()   BEGIN
 SELECT simester.Name as Semester
 from simester;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readStudents` ()   BEGIN

SELECT *FROM students;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readStudent_for_companetion` ()   BEGIN
 SELECT students.FullName as students
 from students;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readSubjects` ()   BEGIN
 SELECT *FROM subjects;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readUsers` ()   BEGIN
 SELECT users.ID, users.Username,users.User_Type as Role, users.Status,users.JoinedDate FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readUsers_for_companetion` ()   BEGIN
 SELECT users.Username as users
 from users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_companetion` ()   BEGIN


SELECT * FROM combanition;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchSemesterName` (IN `$name` VARCHAR(100))   BEGIN
 SELECT simester.Name FROM simester
 WHERE simester.Name=$name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateResult` (IN `$resultID` INT, IN `$publish` VARCHAR(50))   BEGIN
 UPDATE results SET results.Published=$publish
 WHERE results.result_id=$resultID;
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
('C001', 'CA209', '2022-08-19 14:57:01'),
('C002', 'CA201', '2022-08-23 14:42:14'),
('C001', 'CA209', '2022-08-19 14:57:01'),
('C120913', 'CA202', '2022-08-22 08:35:59'),
('C001', 'CA209', '2022-08-19 14:57:01'),
('C120913', 'CA202', '2022-08-22 08:35:59'),
('C001', 'CA209', '2022-08-19 14:57:01'),
('C120913', 'CA202', '2022-08-22 08:35:59'),
('C001', 'CA209', '2022-08-19 14:57:01'),
('C120913', 'CA202', '2022-08-22 08:35:59'),
('C001', 'CA209', '2022-08-19 14:57:01'),
('C120913', 'CA202', '2022-08-22 08:35:59'),
('C001', 'CA209', '2022-08-19 14:57:01'),
('C120913', 'CA202', '2022-08-22 08:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `combanition`
--

CREATE TABLE `combanition` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `bassword` varchar(55) NOT NULL,
  `role` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  `comapniton_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `combanition`
--

INSERT INTO `combanition` (`id`, `username`, `bassword`, `role`, `status`, `comapniton_date`) VALUES
(31, 'ENG-CJ', '1234', 'Admin', 'Active', '2022-08-23 08:06:43'),
(32, 'Farah', '1234', 'student', 'Active', '2022-08-23 08:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `marks_id` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `ResultID` int(11) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`marks_id`, `SubjectID`, `ResultID`, `marks`) VALUES
(70, 17, 47, 90),
(71, 17, 48, 15),
(72, 17, 49, 90),
(73, 17, 50, 78);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `SemesterID` varchar(100) NOT NULL,
  `Class` varchar(50) NOT NULL,
  `StudentID` varchar(100) NOT NULL,
  `Precentage` float(4,2) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Decision` varchar(40) NOT NULL,
  `Published` varchar(50) NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `SemesterID`, `Class`, `StudentID`, `Precentage`, `Status`, `Decision`, `Published`, `DateAdded`) VALUES
(47, 'TWO', 'CA209', 'ST1202', 90.00, 'A', 'Pass', 'No', '2022-08-27 14:14:51'),
(48, 'TWO', 'CA209', 'ST1203', 15.00, 'Fail', 'Fail', 'No', '2022-08-26 16:06:30'),
(49, 'TWO', 'CA209', 'ST1202', 90.00, 'A', 'Pass', 'No', '2022-08-26 16:08:52'),
(50, 'TWO', 'CA209', 'ST1202', 78.00, 'C', 'Pass', 'No', '2022-08-27 14:15:16');

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
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S0007', 'six', '2022-08-22 08:35:42'),
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S0007', 'six', '2022-08-22 08:35:42'),
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S0007', 'six', '2022-08-22 08:35:42'),
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S0007', 'six', '2022-08-22 08:35:42'),
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S0007', 'six', '2022-08-22 08:35:42'),
('S001', 'ONE', '2022-08-19 14:06:36'),
('S002', 'TWO', '2022-08-19 14:06:02'),
('S005', 'FIVE', '2022-08-20 17:07:33'),
('S0007', 'six', '2022-08-22 08:35:42');

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
('ST1200', 'Abdul Rahman Haaji', 'Male', 216218, 'Somalia', 'CA209', 'FIVE', '2022-08-21 13:25:58'),
('ST1202', 'Mohamed', 'Male', 615178163, 'Hodan', 'CA209', 'TWO', '2022-08-23 09:06:25'),
('ST1203', 'Nasra', 'Female', 61517181, 'yaqshid', 'CA209', 'TWO', '2022-08-23 14:39:37'),
('ST1204', 'Farah ali', 'Male', 615171890, 'yaqshid', 'CA209', 'TWO', '2022-08-23 14:39:52'),
('ST1205', 'Mascuud Abdirahman', 'Male', 1727189, 'Hodan', 'CA201', 'FIVE', '2022-08-23 14:43:03'),
('ST1206', 'Abdullahi Khaliid', 'Male', 1727180, 'Hodan', 'CA201', 'FIVE', '2022-08-23 14:43:19'),
('ST1207', 'Mohamed Amin', 'Male', 1727186, 'Hodan', 'CA201', 'FIVE', '2022-08-23 14:43:34'),
('ST1208', 'Sahra ali', 'Female', 912829, 'hodan', 'CA201', 'ONE', '2022-08-24 09:14:08'),
('ST1200', 'Salim', 'Female', 78878, 'Somalia', 'CA209', 'ONE', '2022-08-21 09:06:47'),
('ST1201', 'Farah', 'Female', 1910220190, 'Somalia', 'CA209', 'TWO', '2022-08-21 09:05:51'),
('ST1200', 'Salim', 'Female', 78878, 'Somalia', 'CA209', 'ONE', '2022-08-21 09:06:47'),
('ST1201', 'Farah', 'Female', 1910220190, 'Somalia', 'CA209', 'TWO', '2022-08-21 09:05:51'),
('ST1200', 'Salim', 'Female', 78878, 'Somalia', 'CA209', 'ONE', '2022-08-21 09:06:47'),
('ST1201', 'Farah', 'Female', 1910220190, 'Somalia', 'CA209', 'TWO', '2022-08-21 09:05:51'),
('ST1200', 'Salim', 'Female', 78878, 'Somalia', 'CA209', 'ONE', '2022-08-21 09:06:47'),
('ST1201', 'Farah', 'Female', 1910220190, 'Somalia', 'CA209', 'TWO', '2022-08-21 09:05:51'),
('ST1200', 'Salim', 'Female', 78878, 'Somalia', 'CA209', 'ONE', '2022-08-21 09:06:47'),
('ST1201', 'Farah', 'Female', 1910220190, 'Somalia', 'CA209', 'TWO', '2022-08-21 09:05:51'),
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
(9, 'Mysql', 'FIVE'),
(16, 'PHP', 'ONE'),
(17, 'Python', 'TWO'),
(18, 'C# Programming', 'ONE');

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
('US002', 'Nasra', '9090', 'user', 'active', '2022-08-22 16:53:02'),
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14'),
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14'),
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14'),
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14'),
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14'),
('US001', 'ENG-CJ', '17829', 'admin', 'active', '2022-08-14 13:43:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combanition`
--
ALTER TABLE `combanition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`marks_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SubjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combanition`
--
ALTER TABLE `combanition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
