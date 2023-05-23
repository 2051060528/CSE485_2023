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

// Lấy danh sách các khóa học
function getCourses()
{
    global $conn;

    $courseQuery = "SELECT * FROM courses";
    $courseResult = $conn->query($courseQuery);

    if ($courseResult->num_rows > 0) {
        echo "<h2>Danh sách khóa học:</h2>";
        echo "<table class=\"course-table\">";
        echo "<tr><th>Mã khóa học</th><th>Tên khóa học</th><th>Mô tả</th><th>Ngày học</th><th>Đăng ký</th><th>Hủy đăng ký</th></tr>";

        while ($row = $courseResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['CourseID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['Desception'] . "</td>";
            echo "<td>" . $row['Schedule'] . "</td>";
            echo "<td>";
            echo "<form action=\"class.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"studentID\" value=\"1\">"; // Thay đổi giá trị của studentID tương ứng với sinh viên đăng nhập
            echo "<input type=\"hidden\" name=\"courseID\" value=\"" . $row['CourseID'] . "\">";
            echo "<input type=\"submit\" name=\"register\" value=\"Đăng ký\">";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form action=\"student.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"studentID\" value=\"1\">"; // Thay đổi giá trị của studentID tương ứng với sinh viên đăng nhập
            echo "<input type=\"hidden\" name=\"courseID\" value=\"" . $row['CourseID'] . "\">";
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

// Hiển thị giao diện
echo "<h1>Hệ thống quản lý đăng ký môn học</h1>";

// Hiển thị danh sách khóa học
getCourses();

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
<style>
    h1, h2 {
        text-align: center;
    }

    .course-table {
        width: 100%;
        border-collapse: collapse;
    }

    .course-table th,
    .course-table td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .course-table th {
        background-color: #f2f2f2;
    }
</style>
