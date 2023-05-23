-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for btth02
CREATE DATABASE IF NOT EXISTS `btth02` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `btth02`;

-- Dumping structure for table btth02.attendance
CREATE TABLE IF NOT EXISTS `attendance` (
  `AttendanceID` int(11) NOT NULL,
  `AttendanceTime` datetime DEFAULT NULL,
  `AttendanceStatus` varchar(50) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `ClassID` int(11) DEFAULT NULL,
  PRIMARY KEY (`AttendanceID`),
  KEY `fk_attendance_students` (`StudentID`),
  KEY `fk_attendance_courseclasses` (`ClassID`),
  CONSTRAINT `fk_attendance_courseclasses` FOREIGN KEY (`ClassID`) REFERENCES `courseclasses` (`ClassID`),
  CONSTRAINT `fk_attendance_students` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tạo bảng điểm danh: Bổ sung thông tin về việc điểm danh, như thời gian điểm danh, cách tính trạng thái điểm danh (có mặt, muộn, vắng) và quy tắc điểm danh (sau 5 phút tính muộn, sau 15 phút tính vắng).';

-- Dumping data for table btth02.attendance: ~20 rows (approximately)
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` (`AttendanceID`, `AttendanceTime`, `AttendanceStatus`, `StudentID`, `ClassID`) VALUES
	(1, '2023-05-21 09:00:00', 'Có mặt', 1, 1),
	(2, '2023-05-21 10:30:00', 'Vắng mặt', 2, 1),
	(3, '2023-05-21 09:00:00', 'Có mặt', 3, 1),
	(4, '2023-05-21 13:30:00', 'Vắng mặt', 4, 1),
	(5, '2023-05-21 09:02:00', 'Muộn', 5, 1),
	(6, '2023-05-23 14:00:00', 'Vắng mặt', 6, 3),
	(7, '2023-05-23 09:00:00', 'Có mặt', 7, 4),
	(8, '2023-05-21 16:00:00', 'Có mặt', 8, 4),
	(9, '2023-05-21 09:00:00', 'Có mặt', 9, 5),
	(10, '2023-05-21 11:30:00', 'Vắng mặt', 10, 5),
	(11, '2023-05-21 09:00:00', 'Có mặt', 11, 6),
	(12, '2023-05-21 13:00:00', 'Có mặt', 12, 6),
	(13, '2023-05-21 09:00:00', 'Có mặt', 13, 7),
	(14, '2023-05-21 15:30:00', 'Có mặt', 14, 7),
	(15, '2023-05-21 09:00:00', 'Có mặt', 15, 8),
	(16, '2023-05-21 12:30:00', 'Vắng mặt', 16, 8),
	(17, '2023-05-21 09:00:00', 'Có mặt', 17, 9),
	(18, '2023-05-21 14:30:00', 'Có mặt', 18, 9),
	(19, '2023-05-21 09:00:00', 'Có mặt', 19, 10),
	(20, '2023-05-21 10:30:00', 'Có mặt', 20, 10);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;

-- Dumping structure for table btth02.classschedules
CREATE TABLE IF NOT EXISTS `classschedules` (
  `ScheduleID` int(11) NOT NULL,
  `ClassDate` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `ClassID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ScheduleID`),
  KEY `fk_classSchedules_courseclasses` (`ClassID`),
  CONSTRAINT `fk_classSchedules_courseclasses` FOREIGN KEY (`ClassID`) REFERENCES `courseclasses` (`ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tạo bảng lịch học: Có thể bổ sung thông tin về lịch học cho mỗi lớp học phần, bao gồm ngày học của lớp, thời gian bắt đầu của buổi học, thời gian kết thúc của buổi học, địa điểm diễn ra buổi học và ID lịch học. Ngoài ra còn có ID lớp học phần: Đính kèm lịch học với lớp học phần tương ứng.';

-- Dumping data for table btth02.classschedules: ~30 rows (approximately)
/*!40000 ALTER TABLE `classschedules` DISABLE KEYS */;
INSERT INTO `classschedules` (`ScheduleID`, `ClassDate`, `StartTime`, `EndTime`, `Location`, `ClassID`) VALUES
	(1, '2023-05-21', '09:00:00', '11:00:00', 'Phòng A1', 1),
	(2, '2023-05-23', '14:00:00', '16:00:00', 'Phòng B2', 2),
	(3, '2023-05-24', '10:30:00', '12:30:00', 'Phòng C3', 3),
	(4, '2023-05-25', '13:00:00', '15:00:00', 'Phòng D4', 4),
	(5, '2023-05-26', '08:30:00', '10:30:00', 'Phòng E5', 5),
	(6, '2023-05-27', '11:00:00', '13:00:00', 'Phòng F6', 6),
	(7, '2023-05-28', '14:30:00', '16:30:00', 'Phòng G7', 7),
	(8, '2023-05-29', '09:30:00', '11:30:00', 'Phòng H8', 8),
	(9, '2023-05-30', '12:00:00', '14:00:00', 'Phòng I9', 9),
	(10, '2023-05-31', '15:00:00', '17:00:00', 'Phòng J10', 10),
	(11, '2023-06-01', '09:00:00', '11:00:00', 'Phòng A1', 11),
	(12, '2023-06-02', '14:00:00', '16:00:00', 'Phòng B2', 12),
	(13, '2023-06-03', '10:30:00', '12:30:00', 'Phòng C3', 13),
	(14, '2023-06-04', '13:00:00', '15:00:00', 'Phòng D4', 14),
	(15, '2023-06-05', '08:30:00', '10:30:00', 'Phòng E5', 15),
	(16, '2023-06-06', '11:00:00', '13:00:00', 'Phòng F6', 16),
	(17, '2023-06-07', '14:30:00', '16:30:00', 'Phòng G7', 17),
	(18, '2023-06-08', '09:30:00', '11:30:00', 'Phòng H8', 18),
	(19, '2023-06-09', '12:00:00', '14:00:00', 'Phòng I9', 19),
	(20, '2023-06-10', '15:00:00', '17:00:00', 'Phòng J10', 20),
	(21, '2023-06-11', '09:00:00', '11:00:00', 'Phòng A1', 21),
	(22, '2023-06-12', '14:00:00', '16:00:00', 'Phòng B2', 22),
	(23, '2023-06-13', '10:30:00', '12:30:00', 'Phòng C3', 23),
	(24, '2023-06-14', '13:00:00', '15:00:00', 'Phòng D4', 24),
	(25, '2023-06-15', '08:30:00', '10:30:00', 'Phòng E5', 25),
	(26, '2023-06-16', '11:00:00', '13:00:00', 'Phòng F6', 26),
	(27, '2023-06-17', '14:30:00', '16:30:00', 'Phòng G7', 27),
	(28, '2023-06-18', '09:30:00', '11:30:00', 'Phòng H8', 28),
	(29, '2023-06-19', '12:00:00', '14:00:00', 'Phòng I9', 29),
	(30, '2023-06-20', '15:00:00', '17:00:00', 'Phòng J10', 30);
/*!40000 ALTER TABLE `classschedules` ENABLE KEYS */;

-- Dumping structure for table btth02.courseclasses
CREATE TABLE IF NOT EXISTS `courseclasses` (
  `ClassID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `InstructorID` int(11) DEFAULT NULL,
  `ScheduleID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ClassID`),
  KEY `fk_courseclasses_courses` (`CourseID`),
  KEY `fk_courseclasses_instructors` (`InstructorID`),
  KEY `FK_ScheduleID` (`ScheduleID`),
  CONSTRAINT `FK_ScheduleID` FOREIGN KEY (`ScheduleID`) REFERENCES `classschedules` (`ScheduleID`),
  CONSTRAINT `fk_courseclasses_courses` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  CONSTRAINT `fk_courseclasses_instructors` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tạo bảng lớp học phần: Đại diện cho một lớp học cụ thể trong khóa học, bao gồm thông tin như ID lớp, ID khóa học, ID giảng viên và thời gian học';

-- Dumping data for table btth02.courseclasses: ~30 rows (approximately)
/*!40000 ALTER TABLE `courseclasses` DISABLE KEYS */;
INSERT INTO `courseclasses` (`ClassID`, `CourseID`, `InstructorID`, `ScheduleID`) VALUES
	(1, 1, 111, 17),
	(2, 2, 112, 8),
	(3, 3, 113, 11),
	(4, 4, 114, 1),
	(5, 5, 115, 24),
	(6, 6, 116, 25),
	(7, 7, 117, 27),
	(8, 8, 118, 21),
	(9, 9, 119, 7),
	(10, 10, 120, 29),
	(11, 11, 111, 30),
	(12, 12, 112, 20),
	(13, 13, 113, 3),
	(14, 14, 114, 4),
	(15, 15, 115, 5),
	(16, 16, 116, 12),
	(17, 17, 117, 13),
	(18, 18, 118, 16),
	(19, 19, 119, 28),
	(20, 20, 120, 2),
	(21, 1, 112, 6),
	(22, 2, 113, 9),
	(23, 3, 114, 10),
	(24, 4, 115, 26),
	(25, 5, 116, 14),
	(26, 6, 117, 15),
	(27, 7, 118, 18),
	(28, 8, 119, 19),
	(29, 9, 120, 22),
	(30, 10, 111, 23);
/*!40000 ALTER TABLE `courseclasses` ENABLE KEYS */;

-- Dumping structure for table btth02.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `CourseID` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Desception` varchar(50) DEFAULT NULL,
  `Schedule` date DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `ClassID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CourseID`),
  KEY `fk_courses_departments` (`DepartmentID`),
  KEY `FK_StudentID` (`StudentID`),
  KEY `FK_ClassID` (`ClassID`),
  CONSTRAINT `FK_ClassID` FOREIGN KEY (`ClassID`) REFERENCES `courseclasses` (`ClassID`),
  CONSTRAINT `FK_StudentID` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  CONSTRAINT `fk_courses_departments` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Bảng khóa học: Đại diện cho một khóa học cụ thể, có thông tin như mã khóa học, tiêu đề, mô tả và thời gian học. Mỗi khóa học có ID khóa học duy nhất.';

-- Dumping data for table btth02.courses: ~20 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`CourseID`, `Title`, `Desception`, `Schedule`, `DepartmentID`, `StudentID`, `ClassID`) VALUES
	(1, 'Lập trình C++', 'Khóa học về lập trình C++', '2023-01-01', 1, 12, 12),
	(2, 'Hệ điều hành', 'Khóa học về hệ điều hành', '2023-02-01', 1, 5, 1),
	(3, 'Cơ sở dữ liệu', 'Khóa học về cơ sở dữ liệu', '2023-03-01', 2, 21, 29),
	(4, 'Lập trình web', 'Khóa học về lập trình web', '2023-04-01', 2, 3, 11),
	(5, 'Mạng máy tính', 'Khóa học về mạng máy tính', '2023-05-01', 3, 15, 8),
	(6, 'Trí tuệ nhân tạo', 'Khóa học về trí tuệ nhân tạo', '2023-06-01', 3, 11, 19),
	(7, 'An toàn thông tin', 'Khóa học về an toàn thông tin', '2023-07-01', 4, 13, 22),
	(8, 'Kỹ thuật phần mềm', 'Khóa học về kỹ thuật phần mềm', '2023-08-01', 4, 16, 5),
	(9, 'Hệ thống thông tin', 'Khóa học về hệ thống thông tin', '2023-09-01', 5, 14, 4),
	(10, 'Mô phỏng hệ thống', 'Khóa học về mô phỏng hệ thống', '2023-10-01', 5, 12, 22),
	(11, 'Kế toán quản trị', 'Khóa học về kế toán quản trị', '2023-11-01', 6, 1, 24),
	(12, 'Quản lý dự án', 'Khóa học về quản lý dự án', '2023-12-01', 6, 8, 25),
	(13, 'Tiếng Anh giao tiếp', 'Khóa học về tiếng Anh giao tiếp', '2024-01-01', 7, 19, 21),
	(14, 'Kỹ năng thuyết trình', 'Khóa học về kỹ năng thuyết trình', '2024-02-01', 7, 4, 2),
	(15, 'Kinh tế học', 'Khóa học về kinh tế học', '2024-03-01', 8, 2, 14),
	(16, 'Quản trị kinh doanh', 'Khóa học về quản trị kinh doanh', '2024-04-01', 8, 10, 23),
	(17, 'Marketing', 'Khóa học về marketing', '2024-05-01', 9, 9, 16),
	(18, 'Tài chính doanh nghiệp', 'Khóa học về tài chính doanh nghiệp', '2024-06-01', 9, 7, 27),
	(19, 'Luật doanh nghiệp', 'Khóa học về luật doanh nghiệp', '2024-07-01', 10, 6, 28),
	(20, 'Quyền sở hữu trí tuệ', 'Khóa học về quyền sở hữu trí tuệ', '2024-08-01', 10, 17, 15);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Dumping structure for table btth02.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Bảng Bộ môn có mã bộ môn và tên bộ môn';

-- Dumping data for table btth02.departments: ~10 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`DepartmentID`, `DepartmentName`) VALUES
	(1, 'Khoa Công nghệ thông tin'),
	(2, 'Khoa Kinh tế'),
	(3, 'Khoa Ngôn ngữ học'),
	(4, 'Khoa Toán - Tin học'),
	(5, 'Khoa Vật lý'),
	(6, 'Khoa Hóa học'),
	(7, 'Khoa Sinh học'),
	(8, 'Khoa Xã hội học'),
	(9, 'Khoa Luật'),
	(10, 'Khoa Quản trị kinh doanh');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping structure for table btth02.instructors
CREATE TABLE IF NOT EXISTS `instructors` (
  `InstructorID` int(11) NOT NULL,
  `NameIns` varchar(50) DEFAULT NULL,
  `EmailIns` varchar(50) DEFAULT NULL,
  `Expertise` varchar(50) DEFAULT NULL,
  `ContactInfor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`InstructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Bảng giảng viên: Đại diện cho giảng viên hoặc người hướng dẫn, có thông tin như tên, email, chuyên môn và thông tin liên hệ. Mỗi giảng viên có ID giảng viên duy nhất.';

-- Dumping data for table btth02.instructors: ~10 rows (approximately)
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` (`InstructorID`, `NameIns`, `EmailIns`, `Expertise`, `ContactInfor`) VALUES
	(111, 'Nguyễn Thị Anh', '111@example.com', 'Toán học', '123-456-7890'),
	(112, 'Trần Văn Bình', '112@example.com', 'Văn học', '987-654-3210'),
	(113, 'Lê Thị Hương', '113@example.com', 'Khoa học máy tính', '555-555-5555'),
	(114, 'Phạm Minh Tuấn', '114@example.com', 'Vật lý', '444-444-4444'),
	(115, 'Đặng Thị Hoa', '115@example.com', 'Hóa học', '777-777-7777'),
	(116, 'Vũ Anh Hùng', '116@example.com', 'Lịch sử', '666-666-6666'),
	(117, 'Nguyễn Thanh Xuân', '117@example.com', 'Kinh tế', '222-222-2222'),
	(118, 'Nguyễn Văn Tuấn', '118@example.com', 'Sinh học', '999-999-9999'),
	(119, 'Phạm Thị Lan', '119@example.com', 'Tâm lý học', '888-888-8888'),
	(120, 'Hoàng Thị Mỹ Linh', '120@example.com', 'Mỹ thuật', '333-333-3333');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;

-- Dumping structure for table btth02.students
CREATE TABLE IF NOT EXISTS `students` (
  `StudentID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `ContactInformation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table btth02.students: ~21 rows (approximately)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`StudentID`, `Name`, `DateOfBirth`, `Email`, `ContactInformation`) VALUES
	(1, 'Bùi Đức Anh', '2002-05-10', '1951060503@gmail.com', '091-111-1111'),
	(2, 'Vũ Ngọc Anh', '2002-06-11', '1951060537@gmail.com', '092-222-2222'),
	(3, 'Mai Linh Chi', '2002-07-10', '2151062725@gmail.com', '093-333-3333'),
	(4, 'Trịnh Ngọc Hải', '2002-03-22', '2051063822@gmail.com', '094-444-4444'),
	(5, 'Bùi Minh Hiếu', '2002-06-01', '2051063767@gmail.com', '095-555-5555'),
	(6, 'Lưu Việt Hoàng', '2002-09-02', '2051063749@gmail.com', '096-666-6666'),
	(7, 'Nguyễn Việt Hoàng', '2002-04-10', '2051063750@gmail.com', '097-777-7777'),
	(8, 'Trần Huy Hoàng', '2002-07-28', '1951060725@gmail.com', '098-888-8888'),
	(9, 'Lương Chung Hội', '2002-08-12', '2051060527@gmail.com', '099-999-9999'),
	(10, 'Nguyễn Công Huấn', '2002-05-10', '2051062307@gmail.com', '091-234-5688'),
	(11, 'Lê Thị Kim Ngân', '2002-06-15', '2151062336@gmail.com', '092-345-6789'),
	(12, 'Phạm Thị Lan', '2002-07-20', '2151063221@gmail.com', '093-456-7890'),
	(13, 'Trần Văn Long', '2002-08-25', '1951061437@gmail.com', '094-567-8901'),
	(14, 'Võ Thị Mỹ', '2002-09-30', '2051062819@gmail.com', '095-678-9012'),
	(15, 'Lê Thị Ngọc', '2002-10-05', '2151063683@gmail.com', '096-789-0123'),
	(16, 'Nguyễn Văn Oanh', '2002-11-10', '1951064542@gmail.com', '097-890-1234'),
	(17, 'Trần Thị Phương', '2002-12-15', '2051065291@gmail.com', '098-901-2345'),
	(18, 'Đặng Văn Quân', '2002-01-20', '2151066347@gmail.com', '099-012-3456'),
	(19, 'Nguyễn Thị Sương', '2002-02-25', '1951067312@gmail.com', '091-123-4567'),
	(20, 'Trần Văn Tâm', '2002-03-01', '2051068465@gmail.com', '092-234-5678'),
	(21, 'Võ Thị Uyên', '2002-04-05', '2151069530@gmail.com', '093-345-6789');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table btth02.users
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `AccessRole` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table btth02.users: ~20 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `AccessRole`) VALUES
	(1, 'Nguyễn Thị Anh', '111@example.com', 'cse485', 'admin'),
	(2, 'Trần Văn Bình', '112@example.com', 'cse485', 'admin'),
	(3, 'Lê Thị Hương', '113@example.com', 'cse485', 'admin'),
	(4, 'Phạm Minh Tuấn', '114@example.com', 'cse485', 'admin'),
	(5, 'Đặng Thị Hoa', '115@example.com', 'cse485', 'admin'),
	(6, 'Vũ Anh Hùng', '116@example.com', 'cse485', 'admin'),
	(7, 'Nguyễn Thanh Xuân', '117@example.com', 'cse485', 'admin'),
	(8, 'Nguyễn Văn Tuấn', '118@example.com', 'cse485', 'admin'),
	(9, 'Phạm Thị Lan', '119@example.com', 'cse485', 'admin'),
	(10, 'Hoàng Thị Mỹ Linh', '120@example.com', 'cse485', 'admin'),
	(11, 'Bùi Đức Anh', '1951060503@gmail.com', 'user123', 'user'),
	(12, 'Vũ Ngọc Anh', '1951060537@gmail.com', 'user123', 'user'),
	(13, 'Mai Linh Chi', '2151062725@gmail.com', 'user123', 'user'),
	(14, 'Trịnh Ngọc Hải', '2051063822@gmail.com', 'user123', 'user'),
	(15, 'Bùi Minh Hiếu', '2051063767@gmail.com', 'user123', 'user'),
	(16, 'Lưu Việt Hoàng', '2051063749@gmail.com', 'user123', 'user'),
	(17, 'Nguyễn Việt Hoàng', '2051063750@gmail.com', 'user123', 'user'),
	(18, 'Trần Huy Hoàng', '19510607250@gmail.com', 'user123', 'user'),
	(19, 'Lương Chung Hội', '2051060527@gmail.com', 'user123', 'user'),
	(20, 'Nguyễn Công Huấn', '2051062307@gmail.com', 'user123', 'user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;