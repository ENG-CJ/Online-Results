-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2022 at 10:33 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `findNewuser` (IN `userID` VARCHAR(55), IN `Pass` VARCHAR(55))   BEGIN
 SELECT combanition.RollNumber,combanition.username,combanition.bassword,combanition.role
 
 ,students.FullName,students.Class,students.Semester

 
 FROM combanition
  INNER JOIN students ON students.RollNumber=combanition.RollNumber
 WHERE  combanition.username=userID OR combanition.RollNumber=userID AND combanition.bassword=Pass;
 
 
 




SELECT subjects.Name,marks.marks,results.Precentage,results.Status
 


FROM results
INNER JOIN marks ON marks.ResultID=results.result_id
INNER JOIN subjects ON subjects.SubjectID=marks.SubjectID

WHERE StudentID=userID;





END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `findUser` (IN `$username` VARCHAR(100), IN `$pass` VARCHAR(100))   BEGIN
 SELECT *FROM combanition
 WHERE combanition.username=$username AND combanition.bassword=$pass;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTotal` (IN `$id` VARCHAR(90))   BEGIN

SELECT SUM(marks.marks)as Total FROM marks
INNER JOIN subjects on marks.SubjectID=subjects.SubjectID
JOIN results on marks.ResultID=results.result_id
WHERE results.StudentID=$id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTotalSubject` (IN `$id` VARCHAR(100))   BEGIN

SELECT COUNT(marks.SubjectID) as 'Length'FROM marks
INNER JOIN subjects on marks.SubjectID=subjects.SubjectID
INNER JOIN results ON marks.ResultID=results.result_id
WHERE results.StudentID=$id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PassAndFail_Visual` (IN `$class` VARCHAR(70), IN `$semester` VARCHAR(70))   BEGIN

SELECT results.Decision, COUNT(results.Decision) as Perecentage FROM results
WHERE results.SemesterID=$semester AND results.Class=$class
GROUP BY results.Decision;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readClassNames` ()   BEGIN
SELECT classes.Name FROM classes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readFinalResult` (IN `$id` VARCHAR(100))   BEGIN

SELECT subjects.Name,marks.marks FROM marks
INNER JOIN subjects on marks.SubjectID=subjects.SubjectID
INNER JOIN results on marks.ResultID=results.result_id
WHERE results.StudentID=$id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `readStudentsID` ()   BEGIN
SELECT students.RollNumber FROM students;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `RebortStudents` (IN `ID` VARCHAR(88))   BEGIN

CREATE TEMPORARY TABLE Reborts
SELECT students.RollNumber,students.FullName,students.Gender,students.Class,students.Semester


FROM students

WHERE RollNumber=ID;



SELECT * FROM Reborts;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RebortStudentsTABLE` (IN `ID` VARCHAR(88))   BEGIN



CREATE TEMPORARY TABLE Reborts



SELECT subjects.Name,marks.marks,results.Precentage,results.Status
 


FROM results
INNER JOIN marks ON marks.ResultID=results.result_id
INNER JOIN subjects ON subjects.SubjectID=marks.SubjectID

WHERE StudentID=ID;
SELECT * FROM Reborts;










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
('C001', 'CA201', '2022-08-28 08:13:11'),
('C002', 'CA202', '2022-08-28 08:13:22'),
('c1000', 'CA202', '2022-08-31 13:48:06');

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
(34, 'ST101', '6767', 'student', 'Active', '2022-09-01 14:59:37'),
(35, 'ST1002', '7878', 'student', 'Active', '2022-09-01 15:33:00'),
(36, 'ST1003', '8989', 'student', 'Active', '2022-09-01 15:33:09'),
(37, 'ST100', '7676', 'student', 'Active', '2022-09-01 16:39:18'),
(38, 'ST104', '1212', 'student', 'Active', '2022-09-02 05:39:51'),
(39, 'ST105', '1919', 'student', 'Active', '2022-09-02 05:40:02'),
(40, 'ST106', '2020', 'student', 'Active', '2022-09-02 05:40:10'),
(41, 'ST107', '3030', 'student', 'Active', '2022-09-02 05:40:18'),
(42, 'Nasra', '9090', 'Admin', 'NoActive', '2022-09-03 07:46:27'),
(43, 'ENG-CJ', '12345', 'Admin', 'Active', '2022-09-03 07:46:42'),
(44, 'Huseen', '6767', 'User', 'Active', '2022-09-03 07:59:01');

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
(73, 17, 50, 78),
(74, 19, 51, 90),
(75, 21, 51, 85),
(76, 19, 52, 43),
(77, 21, 52, 32),
(78, 19, 53, 90),
(79, 21, 53, 80),
(80, 19, 54, 90),
(81, 21, 54, 80),
(82, 19, 55, 67),
(83, 21, 55, 13),
(144, 27, 55, 100),
(145, 25, 55, 100),
(146, 26, 55, 50),
(147, 25, 56, 90),
(148, 22, 56, 98),
(149, 26, 56, 99),
(150, 23, 56, 100),
(151, 24, 56, 97),
(152, 25, 57, 100),
(153, 22, 57, 78),
(154, 26, 57, 89),
(155, 23, 57, 80),
(156, 24, 57, 88),
(157, 25, 58, 90),
(158, 22, 58, 89),
(159, 26, 58, 78),
(160, 23, 58, 80),
(161, 24, 58, 90),
(162, 25, 59, 97),
(163, 22, 59, 92),
(164, 26, 59, 87),
(165, 23, 59, 95),
(166, 24, 59, 89);

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
(53, 'TWO', 'CA202', 'ST101', 85.00, 'B', 'Pass', 'Yes', '2022-08-28 08:51:05'),
(54, 'TWO', 'CA202', 'ST100', 85.00, 'B', 'Pass', 'No', '2022-08-28 08:44:45'),
(56, 'FOUR', 'CA202', 'ST104', 96.80, 'A', 'Pass', 'Yes', '2022-09-03 08:02:36'),
(57, 'FOUR', 'CA202', 'ST105', 87.00, 'B', 'Pass', 'No', '2022-09-02 05:38:49'),
(58, 'FOUR', 'CA202', 'ST106', 85.40, 'B', 'Pass', 'No', '2022-09-02 05:39:07'),
(59, 'FOUR', 'CA202', 'ST107', 92.00, 'A', 'Pass', 'No', '2022-09-02 05:39:28');

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
('S001', 'ONE', '2022-08-28 08:13:40'),
('S002', 'TWO', '2022-08-28 08:13:45'),
('S002', 'THREE', '2022-08-28 08:13:52'),
('S005', 'FIVE', '2022-09-02 05:32:57'),
('S004', 'FOUR', '2022-09-02 05:33:58');

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
('ST100', 'Mohamed', 'Male', 71227616, 'Somalia', 'CA202', 'TWO', '2022-08-28 08:15:14'),
('ST101', 'Ali', 'Male', 7122767, 'Somalia', 'CA202', 'TWO', '2022-08-28 08:15:32'),
('ST1002', 'Nasra Mohamed', 'Female', 2817271, 'Hodan', 'CA202', 'THREE', '2022-09-01 15:32:13'),
('ST1003', 'Abdulrahman Ali', 'Male', 28172790, 'Hodan', 'CA201', 'ONE', '2022-09-01 15:32:34'),
('ST104', 'Abdulrahman Haaji', 'Male', 281781, 'Hodan', 'CA202', 'FOUR', '2022-09-02 05:34:43'),
('ST105', 'Hamdi Ahmed', 'Female', 612727279, 'Hodan', 'CA202', 'FOUR', '2022-09-02 05:35:06'),
('ST106', 'Mascuud Abdirahman Shiekh', 'Male', 612727666, 'Hodan', 'CA202', 'FOUR', '2022-09-02 05:35:27'),
('ST107', 'Fahma Farah Hassan', 'Female', 6127255, 'Hodan', 'CA202', 'FOUR', '2022-09-02 05:35:51');

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
(19, 'Python', 'TWO'),
(20, 'JavaScript', 'THREE'),
(21, 'Calclus', 'TWO'),
(22, 'Java', 'FOUR'),
(23, 'DLD', 'FOUR'),
(24, 'Statitics', 'FOUR'),
(25, 'P.Management', 'FOUR'),
(26, 'C# Programming 1', 'FOUR');

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
('US002', 'Nasra', '9090', 'user', 'active', '2022-08-22 16:53:02'),
('US001', 'ENG-CJ', '12345', 'admin', 'active', '2022-09-03 07:57:48'),
('US003', 'Huseen', '8080', 'user', 'active', '2022-09-03 07:58:33');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
