<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "2051060528";
$dbname = "btth02";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Đăng ký khóa học
if (isset($_POST['register'])) {
    $studentID = $_POST['studentID'];
    $courseID = $_POST['courseID'];

    // Kiểm tra nếu sinh viên đã đăng ký khóa học này trước đó
    $checkQuery = "SELECT * FROM registrations WHERE studentID = '$studentID' AND courseID = '$courseID'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "Sinh viên đã đăng ký khóa học này trước đó.";
    } else {
        // Thực hiện đăng ký khóa học
        $registerQuery = "INSERT INTO registrations (studentID, courseID) VALUES ('$studentID', '$courseID')";
        if ($conn->query($registerQuery) === TRUE) {
            echo "Đăng ký khóa học thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}

// Xóa khóa học đã đăng ký
if (isset($_POST['unregister'])) {
    $studentID = $_POST['studentID'];
    $courseID = $_POST['courseID'];

    // Thực hiện xóa khóa học đã đăng ký
    $unregisterQuery = "DELETE FROM registrations WHERE studentID = '$studentID' AND courseID = '$courseID'";
    if ($conn->query($unregisterQuery) === TRUE) {
        echo "Hủy đăng ký khóa học thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Hiển thị lịch học của sinh viên
function displayCourseSchedule($studentID)
{
    global $conn;

    $scheduleQuery = "SELECT courses.CourseID, courses.CourseName, classes.ClassDate, classes.StartTime, classes.EndTime, classes.Location
                      FROM registrations
                      INNER JOIN courses ON registrations.courseID = courses.CourseID
                      INNER JOIN classes ON courses.CourseID = classes.CourseID
                      WHERE registrations.studentID = '$studentID'";
    
    $scheduleResult = $conn->query($scheduleQuery);

    if ($scheduleResult->num_rows > 0) {
        echo "<h2>Lịch học của bạn:</h2>";
        echo "<table>";
        echo "<tr><th>Khóa học</th><th>Ngày học</th><th>Thời gian</th><th>Địa điểm</th></tr>";

        while ($row = $scheduleResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['CourseName'] . "</td>";
            echo "<td>" . $row['ClassDate'] . "</td>";
            echo "<td>" . $row['StartTime'] . " - " . $row['EndTime'] . "</td>";
            echo "<td>" . $row['Location'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Bạn chưa đăng ký khóa học nào.";
    }
}

// Điểm danh
function markAttendance($studentID, $classID)
{
    global $conn;

    // Kiểm tra thời gian để xác định trạng thái điểm danh
    $classQuery = "SELECT ClassDate, StartTime FROM classes WHERE ClassID = '$classID'";
    $classResult = $conn->query($classQuery);

    if ($classResult->num_rows > 0) {
        $classData = $classResult->fetch_assoc();
        $classDate = $classData['ClassDate'];
        $startTime = $classData['StartTime'];
        
        $currentDateTime = date('Y-m-d H:i:s');
        $attendanceStatus = '';

        if ($currentDateTime <= $classDate . ' ' . $startTime) {
            $attendanceStatus = 'Đang chờ điểm danh';
        } elseif (strtotime($currentDateTime) <= strtotime($classDate . ' ' . $startTime) + (5 * 60)) {
            $attendanceStatus = 'Có mặt';
        } elseif (strtotime($currentDateTime) <= strtotime($classDate . ' ' . $startTime) + (15 * 60)) {
            $attendanceStatus = 'Muộn';
        } else {
            $attendanceStatus = 'Vắng';
        }

        // Thực hiện điểm danh
        $markQuery = "INSERT INTO attendance (AttendanceTime, AttendanceStatus, StudentID, ClassID)
                      VALUES ('$currentDateTime', '$attendanceStatus', '$studentID', '$classID')";
        if ($conn->query($markQuery) === TRUE) {
            echo "Điểm danh thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Không tìm thấy thông tin lớp học.";
    }
}

// Lấy danh sách các khóa học
function getCourses()
{
    global $conn;

    $courseQuery = "SELECT * FROM courses";
    $courseResult = $conn->query($courseQuery);

    if ($courseResult->num_rows > 0) {
        echo "<h2>Danh sách khóa học:</h2>";
        echo "<table>";
        echo "<tr><th>Mã khóa học</th><th>Tên khóa học</th><th>Giảng viên</th><th>Thao tác</th></tr>";

        while ($row = $courseResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['CourseID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['Desception'] . "</td>";
            echo "<td>" . $row['Schedule'] . "</td>";
            echo "<td>";
            echo "<form action=\"index.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"studentID\" value=\"1\">"; // Thay đổi giá trị của studentID tương ứng với sinh viên đăng nhập
            echo "<input type=\"hidden\" name=\"courseID\" value=\"" . $row['CourseID'] . "\">";
            echo "<input type=\"submit\" name=\"register\" value=\"Đăng ký\">";
            echo "<input type=\"submit\" name=\"unregister\" value=\"Hủy đăng ký\">";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Không có khóa học nào.";
    }
}

// Lấy danh sách khóa học đã đăng ký
function getRegisteredCourses($studentID)
{
    global $conn;

    $registeredQuery = "SELECT registrations.studentID, courses.CourseID, courses.CourseName, courses.Lecturer
                        FROM registrations
                        INNER JOIN courses ON registrations.courseID = courses.CourseID
                        WHERE registrations.studentID = '$studentID'";
    $registeredResult = $conn->query($registeredQuery);

    if ($registeredResult->num_rows > 0) {
        echo "<h2>Khóa học đã đăng ký:</h2>";
        echo "<table>";
        echo "<tr><th>Mã khóa học</th><th>Tên khóa học</th><th>Giảng viên</th></tr>";

        while ($row = $registeredResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['CourseID'] . "</td>";
            echo "<td>" . $row['CourseName'] . "</td>";
            echo "<td>" . $row['Lecturer'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Bạn chưa đăng ký khóa học nào.";
    }
}

// Lấy danh sách sinh viên
function getStudents()
{
    global $conn;

    $studentQuery = "SELECT * FROM students";
    $studentResult = $conn->query($studentQuery);

    if ($studentResult->num_rows > 0) {
        echo "<h2>Danh sách sinh viên:</h2>";
        echo "<table>";
        echo "<tr><th>Mã sinh viên</th><th>Tên sinh viên</th></tr>";

        while ($row = $studentResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['StudentID'] . "</td>";
            echo "<td>" . $row['StudentName'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Không có sinh viên nào.";
    }
}

// Hiển thị form điểm danh
function displayAttendanceForm()
{
    global $conn;

    $classQuery = "SELECT * FROM classes";
    $classResult = $conn->query($classQuery);

    if ($classResult->num_rows > 0) {
        echo "<h2>Điểm danh</h2>";
        echo "<form action=\"index.php\" method=\"post\">";
        echo "<label for=\"classID\">Chọn lớp học:</label>";
        echo "<select name=\"classID\" id=\"classID\">";

        while ($row = $classResult->fetch_assoc()) {
            echo "<option value=\"" . $row['ClassID'] . "\">" . $row['CourseName'] . " - " . $row['ClassDate'] . " - " . $row['StartTime'] . "</option>";
        }

        echo "</select>";
        echo "<br><br>";
        echo "<input type=\"hidden\" name=\"studentID\" value=\"1\">"; // Thay đổi giá trị của studentID tương ứng với sinh viên đăng nhập
        echo "<input type=\"submit\" name=\"attendance\" value=\"Điểm danh\">";
        echo "</form>";
    } else {
        echo "Không có lớp học nào.";
    }
}

// Xử lý yêu cầu đăng ký, hủy đăng ký và điểm danh
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $studentID = $_POST['studentID'];
        $courseID = $_POST['courseID'];

        // Thực hiện đăng ký khóa học
        $registerQuery = "INSERT INTO registrations (studentID, courseID) VALUES ('$studentID', '$courseID')";
        if ($conn->query($registerQuery) === TRUE) {
            echo "Đăng ký khóa học thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } elseif (isset($_POST['unregister'])) {
        $studentID = $_POST['studentID'];
        $courseID = $_POST['courseID'];

        // Thực hiện xóa khóa học đã đăng ký
        $unregisterQuery = "DELETE FROM registrations WHERE studentID = '$studentID' AND courseID = '$courseID'";
        if ($conn->query($unregisterQuery) === TRUE) {
            echo "Hủy đăng ký khóa học thành công.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } elseif (isset($_POST['attendance'])) {
        $studentID = $_POST['studentID'];
        $classID = $_POST['classID'];

        // Thực hiện điểm danh
        markAttendance($studentID, $classID);
    }
}

// Hiển thị giao diện
echo "<h1>Hệ thống quản lý đăng ký môn học và điểm danh</h1>";

// Hiển thị danh sách khóa học
getCourses();

// Hiển thị lịch học của sinh viên
displayCourseSchedule(1); // Thay đổi giá trị của studentID tương ứng với sinh viên đăng nhập

// Hiển thị danh sách khóa học đã đăng ký
getRegisteredCourses(1); // Thay đổi giá trị của studentID tương ứng với sinh viên đăng nhập

// Hiển thị danh sách sinh viên (dành cho quản lý)
getStudents();

// Hiển thị form điểm danh
displayAttendanceForm();

// Đóng kết nối cơ sở dữ liệu
$conn->close();

?>